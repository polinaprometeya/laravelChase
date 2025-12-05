// import EventList from './EventList';

function App() {
    return (
        <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
            <div className="container mx-auto px-4 py-8">
                <header className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        Ghost Management
                    </h1>
                    <p className="text-gray-600 dark:text-gray-400 mt-2">
                        Event Management System
                    </p>
                </header>
                
                <main>
                    <div className="text-center py-12">
                        <p className="text-gray-600 dark:text-gray-400">
                            Welcome to Ghost Management
                        </p>
                    </div>
                    {/* <EventList /> */}
                </main>
            </div>
        </div>
    );
}

export default App;

