// resources/js/pages/Dashboard.jsx
import { useEffect, useState } from 'react';
import { useAuth } from '../hooks/useAuth';
import SystemCard from '../components/systems/SystemCard';

export default function Dashboard() {
  const { user } = useAuth();
  const [systems, setSystems] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchSystems = async () => {
      try {
        const response = await axios.get('/api/systems');
        setSystems(response.data);
      } catch (error) {
        console.error('Error fetching systems:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchSystems();
  }, []);

  if (loading) return <LoadingSpinner />;

  return (
    <div className="systems-dashboard">
      <h1>Bienvenido, {user.name}</h1>
      <div className="systems-grid">
        {systems.map(system => (
          <SystemCard 
            key={system.id} 
            system={system} 
            hasAccess={user.systems.includes(system.id)}
          />
        ))}
      </div>
    </div>
  );
}