import EventCard from "./EventCard";

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
            <EventCard
                event={event}
                formatEventDate={formatEventDate}
                className="event-show-card"
                descriptionClassName="event-show-description"
            />
        </>
    );
}
