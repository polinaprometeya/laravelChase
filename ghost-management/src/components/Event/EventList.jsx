import { useState, useEffect } from 'react';
// Use window.axios instead of importing axios directly
// window.axios is configured in bootstrap.js with CSRF tokens, headers, and interceptors
// This ensures all HTTP requests use the same configured instance
import './Event.css';

// useState() cannot be nested somewhere else, has to be used directly at the top level
// useEffect() runs after the component renders - the empty array [] means it only runs once when component mounts
function EventList() {
    // State allows React components to change their output over time
    // When state changes, React automatically re-renders the component
    const [eventList, setEventList] = useState([]); // Store the list of events from the API
    const [isLoading, setIsLoading] = useState(true); // Track if we're currently fetching data
    const [errorMessage, setErrorMessage] = useState(null); // Store any error messages

    // useEffect runs after the component first renders
    // The empty dependency array [] means this only runs once when component mounts
    useEffect(() => {
        loadEvents();
    }, []); // Empty array = run only once when component first appears

    // Async function to fetch events from the Laravel API
    // async/await makes it easier to handle promises (asynchronous operations)
    async function loadEvents() {
        try {
            // Set loading to true so we can show a loading message
            setIsLoading(true);
            // Clear any previous errors
            setErrorMessage(null);
            
            // Use window.axios which is configured in bootstrap.js
            // This ensures CSRF tokens, headers, and error interceptors are applied
            // window.axios.get() returns a promise that resolves with the response
            if (!window.axios) {
                throw new Error('Axios is not configured. Make sure bootstrap.js is loaded.');
            }
            const response = await window.axios.get('/api/events');
            
            // The API might return data.data or just data, so we handle both cases
            const eventsData = response.data.data || response.data;
            
            // Update state with the fetched events
            // This will cause React to re-render the component
            setEventList(eventsData);
        } catch (err) {
            // If something goes wrong, catch the error and show a message
            setErrorMessage('Failed to load events. Please try again.');
            console.error('Error fetching events:', err);
        } finally {
            // Always set loading to false when we're done (whether success or error)
            setIsLoading(false);
        }
    }

    // Handle retry button click - just call loadEvents again
    function handleRetry() {
        loadEvents();
    }

    // Handle refresh button click - same as retry
    function handleRefresh() {
        loadEvents();
    }

    // Format the date to be more readable
    function formatEventDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString();
    }

    // Show loading state while fetching data
    if (isLoading) {
        return (
            <div className="event-loading-container">
                <div className="event-loading-text">Loading events...</div>
            </div>
        );
    }

    // Show error state if something went wrong
    if (errorMessage) {
        return (
            <div className="event-error-container">
                <p className="event-error-text">{errorMessage}</p>
                <button
                    onClick={handleRetry}
                    className="event-retry-button"
                >
                    Retry
                </button>
            </div>
        );
    }

    // Map over the eventList array to create event cards
    // .map() creates a new array by calling a function on each item
    // Each event needs a unique "key" prop so React can track which items changed
    const eventCards = eventList.map((event) => (
        <div
            key={event.id} // key prop helps React efficiently update the list
            className="event-card"
        >
            <h3 className="event-name">
                {event.name}
            </h3>
            {/* Conditional rendering: only show description if it exists */}
            {event.description && (
                <p className="event-description">
                    {event.description}
                </p>
            )}
            {/* Conditional rendering: only show date if it exists */}
            {event.start_time && (
                <p className="event-date">
                    {formatEventDate(event.start_time)}
                </p>
            )}
        </div>
    ));

    // Determine what content to show based on whether we have events
    let eventsContent;
    if (eventList.length === 0) {
        // No events found
        eventsContent = (
            <div className="event-empty-state">
                No events found.
            </div>
        );
    } else {
        // Show the grid of event cards
        eventsContent = (
            <div className="event-grid">
                {eventCards}
            </div>
        );
    }

    // Return the main component JSX
    // Fragment (<>) wraps multiple elements without adding extra DOM nodes
    return (
        <>
            <div className="event-header-container">
                <h2 className="event-title">
                    Events
                </h2>
                <button
                    onClick={handleRefresh}
                    className="event-refresh-button"
                >
                    Refresh
                </button>
            </div>

            {eventsContent}
        </>
    );
}

export default EventList;

