import './bootstrap';
import '../resources/css/app.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/App';

const rootElement = document.getElementById('app');

if (rootElement) {
    const root = createRoot(rootElement);
    root.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
} else {
    console.error('Root element with id="app" not found!');
}

