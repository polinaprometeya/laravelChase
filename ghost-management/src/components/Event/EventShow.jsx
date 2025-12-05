export default function EventShow({ event, onBack, formatEventDate }) {
    return (
        <>
            <div className="event-header-container">
                <h2 className="event-title">Event Details</h2>
                <button
                    onClick={onBack}
                    className="event-refresh-button"
                >
                    Back to List
                </button>
            </div>
            <div className="event-card event-show-card">
                <h3 className="event-name">{event.name}</h3>
                {/* Conditional rendering: only show description if it exists */}
                {event.description && (
                    <p className="event-description event-show-description">
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
        </>
    );
}
