import axios from 'axios';
window.axios = axios;

// Set default headers for Laravel
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set CSRF token from meta tag (Laravel provides this)
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Set base URL for API requests (optional - useful if API is on different domain)
// window.axios.defaults.baseURL = '/api';

// Request interceptor (for adding auth tokens, logging, etc.)
window.axios.interceptors.request.use(
    (config) => {
        // You can add auth tokens here if using Bearer tokens
        // const authToken = localStorage.getItem('auth_token');
        // if (authToken) {
        //     config.headers.Authorization = `Bearer ${authToken}`;
        // }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Response interceptor (for handling errors globally)
window.axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        // Handle common errors globally
        if (error.response) {
            switch (error.response.status) {
                // 4xx Client Errors
                case 400:
                    // Bad Request - invalid request syntax
                    console.error('Bad Request:', error.response.data.message || 'Invalid request');
                    break;
                case 401:
                    // Unauthorized - authentication required
                    // window.location.href = '/login';
                    console.error('Unauthorized access - please log in');
                    break;
                case 403:
                    // Forbidden - authenticated but not authorized
                    console.error('Access forbidden - insufficient permissions');
                    break;
                case 404:
                    // Not Found - resource doesn't exist
                    console.error('Resource not found');
                    break;
                case 405:
                    // Method Not Allowed - wrong HTTP method
                    console.error('Method not allowed for this endpoint');
                    break;
                case 408:
                    // Request Timeout
                    console.error('Request timeout - please try again');
                    break;
                case 409:
                    // Conflict - resource conflict (e.g., duplicate entry)
                    console.error('Conflict:', error.response.data.message || 'Resource conflict');
                    break;
                case 422:
                    // Unprocessable Entity - validation errors
                    console.error('Validation errors:', error.response.data.errors);
                    break;
                case 429:
                    // Too Many Requests - rate limiting
                    console.error('Too many requests - please slow down');
                    break;
                
                // 5xx Server Errors
                case 500:
                    // Internal Server Error
                    console.error('Internal server error - please try again later');
                    break;
                case 502:
                    // Bad Gateway - server acting as gateway got invalid response
                    console.error('Bad gateway - server is temporarily unavailable');
                    break;
                case 503:
                    // Service Unavailable - server overloaded or down
                    console.error('Service unavailable - server is temporarily down');
                    break;
                case 504:
                    // Gateway Timeout - server acting as gateway didn't get response in time
                    console.error('Gateway timeout - request took too long');
                    break;
                
                default:
                    // Other status codes
                    console.error(`Request failed with status ${error.response.status}`);
            }
        } else if (error.request) {
            // Request was made but no response received (network error)
            console.error('Network error - no response from server');
        } else {
            // Something else happened
            console.error('Request error:', error.message);
        }
        return Promise.reject(error);
    }
);

// Set request timeout (optional)
// window.axios.defaults.timeout = 10000; // 10 seconds

