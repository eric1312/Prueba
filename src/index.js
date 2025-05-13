import React from "react";
import ReactDOM from "react-dom";
import "./styles.css"; // Opcional, elimina esta línea si no tienes un archivo styles.css

import App from "./App"; // Asegúrate de que App.jsx exista en la misma carpeta

ReactDOM.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>,
    document.getElementById("root")
);