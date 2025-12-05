export default function EventCard({ event, formatEventDate, onClick, className = "", descriptionClassName = "" }) {
    // Determine if this should be a button (clickable) or div (display only)
    const CardComponent = onClick ? "button" : "div";
    const cardProps = onClick
        ? {
              onClick: () => onClick(event),
              type: "button",
          }
        : {};

    const descriptionClass = `event-description ${descriptionClassName}`.trim();

    return (
        <CardComponent
            className={`event-card ${className}`.trim()}
            {...cardProps}
        >
            <h3 className="event-name">{event.name}</h3>
            {/* Conditional rendering: only show description if it exists */}
            {event.description && (
                <p className={descriptionClass}>{event.description}</p>
            )}
            {/* Conditional rendering: only show date if it exists */}
            {event.start_time && (
                <p className="event-date">{formatEventDate(event.start_time)}</p>
            )}
        </CardComponent>
    );
}
