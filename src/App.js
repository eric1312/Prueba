import React, { useState } from 'react';
import { systems } from './mock/systems';
import AuthLoginForm from './components/AuthLoginForm';
import SystemCard from './components/SystemCard';
import DashboardHeader from './components/DashboardHeader';

const App = () => {
  const [currentSystem, setCurrentSystem] = useState(null);
  const [user, setUser] = useState(null);
  const [view, setView] = useState('systems'); // 'systems', 'login', 'dashboard'

  const handleSystemSelect = (systemName) => {
    setCurrentSystem(systemName);
    setView('login');
  };

  const handleLogin = (credentials) => {
    // Aquí iría la lógica real de autenticación
    setUser(credentials);
    setView('dashboard');
  };

  const handleLogout = () => {
    setUser(null);
    setCurrentSystem(null);
    setView('systems');
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {view === 'systems' && (
        <div className="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold text-center text-gray-900 mb-12">Selecciona un sistema</h1>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {systems.map((system) => (
              <SystemCard
                key={system.name}
                name={system.name}
                description={system.description}
                icon={system.icon}
                onSelect={handleSystemSelect}
              />
            ))}
          </div>
        </div>
      )}

      {view === 'login' && currentSystem && (
        <div className="flex items-center justify-center min-h-screen">
          <AuthLoginForm 
            systemName={currentSystem} 
            onLogin={handleLogin} 
          />
        </div>
      )}

      {view === 'dashboard' && user && (
        <div>
          <DashboardHeader user={user} onLogout={handleLogout} />
          <div className="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">
              Panel de {currentSystem}
            </h2>
            <div className="bg-white p-6 rounded-lg shadow">
              <p>Bienvenido al sistema de {currentSystem}, {user.username}.</p>
              {/* Aquí iría el contenido específico del sistema */}
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default App;

// DONE