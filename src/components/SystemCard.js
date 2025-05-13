const SystemCard = ({ name, description, icon, onSelect }) => {
    return (
      <div 
        onClick={() => onSelect(name)}
        className="cursor-pointer bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow"
      >
        <div className="flex items-center mb-4">
          <div className="bg-blue-100 p-3 rounded-full mr-4">
            {icon}
          </div>
          <h3 className="text-xl font-semibold text-gray-800">{name}</h3>
        </div>
        <p className="text-gray-600">{description}</p>
      </div>
    );
  };
  
  export default SystemCard;