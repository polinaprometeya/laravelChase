import EventList from "./Event/EventList";
import { Header } from "../components/Header/Header";

function App() {
    return (
        <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
            <div className="container mx-auto px-4 py-8">
                <Header />
                <main>
                    <EventList />
                </main>
            </div>
        </div>
    );
}

export default App;
