import axios from "axios";

const api = axios.create({
  baseURL: `${import.meta.env.VITE_API_URL}/api`,
});

api.interceptors.request.use(
  (config) => ({
    ...config,
    headers: {
      'Content-Type': 'application/json',
      ...(config.headers || {}),
    },
  }),
  (error) => Promise.reject(error),
);

api.interceptors.response.use(
  (response) => response,
  async (error) => Promise.reject(error.response?.data ?? error),
);


export default api;

