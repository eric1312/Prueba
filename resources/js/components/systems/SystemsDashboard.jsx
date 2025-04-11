import { useEffect, useState } from 'react';
import api from '../api';
import SystemCard from './SystemCard';

export default function SystemsDashboard() {
    const [systems, setSystems] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchSystems = async () => {
            try {
                const { data } = await api.get('/v1/systems/mine');
                setSystems(data.data);
            } catch (error) {
                console.error('Error fetching systems:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchSystems();
    }, []);

    if (loading) return <div>Loading...</div>;

    return (
        <div className="systems-grid">
            {systems.map(system => (
                <SystemCard key={system.id} system={system} />
            ))}
        </div>
    );
}