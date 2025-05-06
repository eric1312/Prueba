import { useEffect, useState } from 'react';
import axios from 'axios';

function Home() {
  const [data, setData] = useState([]);
  const [form, setForm] = useState({ title: '' });
  const [editingId, setEditingId] = useState(null);

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const response = await axios.get('/api/posts');
      setData(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  const handleCreate = async () => {
    try {
      await axios.post('/api/posts', form);
      setForm({ title: '' });
      fetchData();
    } catch (error) {
      console.error(error);
    }
  };

  const handleUpdate = async (id) => {
    try {
      await axios.put(`/api/posts/${id}`, form);
      setForm({ title: '' });
      setEditingId(null);
      fetchData();
    } catch (error) {
      console.error(error);
    }
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(`/api/posts/${id}`);
      fetchData();
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h1>CRUD con React</h1>
      <form
        onSubmit={(e) => {
          e.preventDefault();
          editingId ? handleUpdate(editingId) : handleCreate();
        }}
      >
        <input
          type="text"
          value={form.title}
          onChange={(e) => setForm({ ...form, title: e.target.value })}
          placeholder="Título"
        />
        <button type="submit">{editingId ? 'Actualizar' : 'Crear'}</button>
      </form>

      <div>
        {data.map((item) => (
          <div key={item.id}>
            <span>{item.title}</span>
            <button onClick={() => setEditingId(item.id) || setForm({ title: item.title })}>
              Editar
            </button>
            <button onClick={() => handleDelete(item.id)}>Eliminar</button>
          </div>
        ))}
      </div>
    </div>
  );
}

export default Home;