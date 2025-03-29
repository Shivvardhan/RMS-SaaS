
import { createRoot } from 'react-dom/client';
import App from './App.tsx';
import './index.css';

// Add a console log to help with debugging
console.log('Initializing application');

createRoot(document.getElementById("root")!).render(<App />);
