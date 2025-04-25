import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Login = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError('');
        try {
            const response = await axios.post('/api/login', {
                username,
                password,
            });
            const { token, permissions } = response.data;
            // Guardar el token y los permisos en el estado global o contexto
            localStorage.setItem('authToken', token);
            localStorage.setItem('userPermissions', JSON.stringify(permissions));
            navigate('/dashboard'); // Redirigir al panel de control
        } catch (error) {
            if (error.response && error.response.status === 401) {
                setError('Credenciales incorrectas');
            } else {
                setError('Error al iniciar sesión');
            }
        }
    };

    return (
        <div>
            <h2>Iniciar Sesión</h2>
            {error && <p style={{ color: 'red' }}>{error}</p>}
            <form onSubmit={handleSubmit}>
                <div>
                    <label htmlFor="username">Usuario:</label>
                    <input
                        type="text"
                        id="username"
                        value={username}
                        onChange={(e) => setUsername(e.target.value)}
                    />
                </div>
                <div>
                    <label htmlFor="password">Contraseña:</label>
                    <input
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    );
};

export default Login;