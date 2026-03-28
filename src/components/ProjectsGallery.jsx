import React, { useState, useEffect } from 'react';
import { LayoutGrid, List, Filter, ExternalLink, ChevronRight, Loader2, Search } from 'lucide-react';
import axios from 'axios';

const ProjectsGallery = () => {
  const [projects, setProjects] = useState([]);
  const [loading, setLoading] = useState(true);
  const [viewMode, setViewMode] = useState('grid'); // 'grid' or 'list'
  const [activeFilter, setActiveFilter] = useState('all');
  const [searchTerm, setSearchTerm] = useState('');

  const categories = [
    { id: 'all', name: 'Todos' },
    { id: 'actual', name: 'Actual' },
    { id: 'infraestructura', name: 'Infraestructura' },
    { id: 'edificacion', name: 'Edificación' },
    { id: 'aplicaciones', name: 'Aplicaciones' },
    { id: 'obra civil', name: 'Obra Civil' },
    { id: 'remodelacion', name: 'Remodelación' },
  ];

  useEffect(() => {
    fetchProjects();
  }, []);

  const fetchProjects = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/projects');
      setProjects(response.data);
    } catch (error) {
      console.error('Error fetching projects:', error);
    } finally {
      setLoading(false);
    }
  };

  const filteredProjects = projects.filter(project => {
    const matchesFilter = activeFilter === 'all' || project.type === activeFilter;
    const matchesSearch = project.title.toLowerCase().includes(searchTerm.toLowerCase()) || 
                          (project.description && project.description.toLowerCase().includes(searchTerm.toLowerCase()));
    return matchesFilter && matchesSearch;
  });

  if (loading) {
    return (
      <div className="flex flex-col items-center justify-center py-20 space-y-4">
        <Loader2 className="w-10 h-10 text-indigo-600 animate-spin" />
        <p className="text-slate-500 font-medium animate-pulse">Cargando portafolio de proyectos...</p>
      </div>
    );
  }

  return (
    <section id="proyectos" className="py-24 bg-white">
      <div className="max-w-7xl mx-auto px-6 md:px-12">
        {/* Header de la sección */}
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
          <div className="max-w-2xl">
            <h2 className="text-4xl font-bold tracking-tight text-slate-900 mb-4">
              Portafolio de <span className="text-indigo-600 underline decoration-indigo-200 underline-offset-8">Proyectos</span>
            </h2>
            <p className="text-slate-600 text-lg">
              Una muestra detallada de las obras, infraestructuras y soluciones técnicas desarrolladas a lo largo de más de 30 años de carrera.
            </p>
          </div>
          
          {/* Toggles de Vista */}
          <div className="flex items-center bg-slate-100 p-1.5 rounded-2xl border border-slate-200 shadow-inner">
            <button 
              onClick={() => setViewMode('grid')}
              className={`p-2.5 rounded-xl transition-all ${viewMode === 'grid' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700'}`}
              title="Vista Cuadrícula"
            >
              <LayoutGrid size={20} />
            </button>
            <button 
              onClick={() => setViewMode('list')}
              className={`p-2.5 rounded-xl transition-all ${viewMode === 'list' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700'}`}
              title="Vista Lista"
            >
              <List size={20} />
            </button>
          </div>
        </div>

        {/* Filtros e Inputs */}
        <div className="flex flex-col lg:flex-row gap-6 mb-12 justify-between">
          <div className="flex flex-wrap gap-2">
            {categories.map(cat => (
              <button
                key={cat.id}
                onClick={() => setActiveFilter(cat.id)}
                className={`px-4 py-2 rounded-xl text-sm font-bold transition-all border ${
                  activeFilter === cat.id 
                    ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-100' 
                    : 'bg-white border-slate-200 text-slate-600 hover:border-indigo-300 hover:text-indigo-600'
                }`}
              >
                {cat.name}
              </button>
            ))}
          </div>
          
          <div className="relative group">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <Search className="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" />
            </div>
            <input
              type="text"
              placeholder="Buscar proyecto..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all w-full lg:w-64"
            />
          </div>
        </div>

        {/* Galería / Lista */}
        {filteredProjects.length === 0 ? (
          <div className="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
            <Filter className="mx-auto h-12 w-12 text-slate-300 mb-4" />
            <h3 className="text-lg font-bold text-slate-900 mb-1">No se encontraron proyectos</h3>
            <p className="text-slate-500">Prueba con otra categoría o término de búsqueda.</p>
          </div>
        ) : (
          <div className={viewMode === 'grid' 
            ? "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-500" 
            : "space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500"
          }>
            {filteredProjects.map((project) => (
              viewMode === 'grid' ? (
                <div key={project.id} className="group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                  <div className="relative aspect-[4/3] overflow-hidden">
                    <img 
                      src={project.image_path || 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80'} 
                      alt={project.title}
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div className="absolute top-4 left-4">
                      <span className="bg-white/90 backdrop-blur-md text-indigo-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm border border-slate-100">
                        {project.type}
                      </span>
                    </div>
                  </div>
                  <div className="p-6 flex-1 flex flex-col">
                    <h3 className="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">
                      {project.title}
                    </h3>
                    <p className="text-slate-600 text-sm line-clamp-2 mb-4 flex-1">
                      {project.description}
                    </p>
                    <div className="flex flex-wrap gap-1.5 mb-4">
                      {project.tags && Array.isArray(project.tags) && project.tags.map((tag, i) => (
                        <span key={i} className="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-md font-medium">#{tag}</span>
                      ))}
                    </div>
                    {project.url && (
                      <a 
                        href={project.url} 
                        target="_blank" 
                        rel="noopener noreferrer"
                        className="flex items-center text-indigo-600 font-bold text-xs uppercase tracking-widest hover:translate-x-1 transition-transform"
                      >
                        Ver Detalles <ExternalLink size={14} className="ml-1.5" />
                      </a>
                    )}
                  </div>
                </div>
              ) : (
                <div key={project.id} className="group flex items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all gap-6">
                  <div className="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 hidden sm:block">
                    <img src={project.image_path} alt={project.title} className="w-full h-full object-cover" />
                  </div>
                  <div className="flex-1">
                    <div className="flex items-center gap-3 mb-1">
                      <span className="text-[10px] font-bold text-indigo-500 uppercase tracking-tighter bg-indigo-50 px-2 py-0.5 rounded">
                        {project.type}
                      </span>
                      <h3 className="text-base font-bold text-slate-900">{project.title}</h3>
                    </div>
                    <p className="text-slate-500 text-sm line-clamp-1">{project.description}</p>
                  </div>
                  <div className="hidden md:flex flex-wrap gap-1 max-w-[200px] justify-end">
                    {project.tags && project.tags.map((tag, i) => (
                      <span key={i} className="text-[9px] bg-slate-50 border border-slate-100 text-slate-400 px-1.5 py-0.5 rounded">#{tag}</span>
                    ))}
                  </div>
                  <ChevronRight className="text-slate-300 group-hover:text-indigo-600 transition-colors" />
                </div>
              )
            ))}
          </div>
        )}
      </div>
    </section>
  );
};

export default ProjectsGallery;
