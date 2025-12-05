import React, { useState, useEffect } from 'react';
import axios from 'axios';

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
            <div className="flex justify-center items-center py-12">
                <div className="text-gray-600 dark:text-gray-400">Loading events...</div>
            </div>
        );
    }

    if (error) {
        return (
            <div className="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <p className="text-red-800 dark:text-red-200">{error}</p>
                <button
                    onClick={fetchEvents}
                    className="mt-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                >
                    Retry
                </button>
            </div>
        );
    }

    return (
        <div>
            <div className="flex justify-between items-center mb-6">
                <h2 className="text-2xl font-semibold text-gray-900 dark:text-white">
                    Events
                </h2>
                <button
                    onClick={fetchEvents}
                    className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
                >
                    Refresh
                </button>
            </div>

            {events.length === 0 ? (
                <div className="text-center py-12 text-gray-500 dark:text-gray-400">
                    No events found.
                </div>
            ) : (
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    {events.map((event) => (
                        <div
                            key={event.id}
                            className="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"
                        >
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {event.name}
                            </h3>
                            {event.description && (
                                <p className="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                    {event.description}
                                </p>
                            )}
                            {event.start_time && (
                                <p className="text-sm text-gray-500 dark:text-gray-500">
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

