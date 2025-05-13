const DashboardHeader = ({ user, onLogout }) => {
  return (
    <header className="bg-white shadow-sm">
      <div className="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 className="text-xl font-bold text-gray-900">HostSys</h1>
        <div className="flex items-center space-x-4">
          <span className="text-gray-700">Bienvenido, {user.username}</span>
          <button
            onClick={onLogout}
            className="text-blue-600 hover:text-blue-800"
          >
            Cerrar sesión
          </button>
        </div>
      </div>
    </header>
  );
};

export default DashboardHeader;