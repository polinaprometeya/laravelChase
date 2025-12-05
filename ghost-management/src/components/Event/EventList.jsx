import { useState, useEffect } from 'react';
import axios from 'axios';
import './Event.css';

function EventList() {
    const [events, setEvents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchEvents();
    }, []);

    const fetchEvents = async () => {
        try {
            setLoading(true);
            // Call your Laravel API endpoint
            const response = await axios.get('/api/events');
            setEvents(response.data.data || response.data);
            setError(null);
        } catch (err) {
            setError('Failed to load events. Please try again.');
            console.error('Error fetching events:', err);
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <div className="event-loading-container">
                <div className="event-loading-text">Loading events...</div>
            </div>
        );
    }

    if (error) {
        return (
            <div className="event-error-container">
                <p className="event-error-text">{error}</p>
                <button
                    onClick={fetchEvents}
                    className="event-retry-button"
                >
                    Retry
                </button>
            </div>
        );
    }

    return (
        <div>
            <div className="event-header-container">
                <h2 className="event-title">
                    Events
                </h2>
                <button
                    onClick={fetchEvents}
                    className="event-refresh-button"
                >
                    Refresh
                </button>
            </div>

            {events.length === 0 ? (
                <div className="event-empty-state">
                    No events found.
                </div>
            ) : (
                <div className="event-grid">
                    {events.map((event) => (
                        <div
                            key={event.id}
                            className="event-card"
                        >
                            <h3 className="event-name">
                                {event.name}
                            </h3>
                            {event.description && (
                                <p className="event-description">
                                    {event.description}
                                </p>
                            )}
                            {event.start_time && (
                                <p className="event-date">
                                    {new Date(event.start_time).toLocaleDateString()}
                                </p>
                            )}
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

export default EventList;

