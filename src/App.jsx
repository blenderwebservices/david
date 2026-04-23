import React, { useState, useEffect } from 'react';
import davidGomezPhoto from './assets/david-gomez-toon.jpeg';
import david1 from './assets/david-gomez-1.jpeg';
import david2 from './assets/david-gomez-2.jpeg';
import { Github, Linkedin, ExternalLink, Calendar, Mail, FileText, ChevronRight, Menu, X, ArrowRight, MessageCircle, MapPin, Award, CheckCircle2, TrendingUp, Users, Phone, Globe, Briefcase, GraduationCap, Search, Download, Quote } from 'lucide-react';
import Chatbot from './components/Chatbot';
import ProjectsGallery from './components/ProjectsGallery';

const App = () => {
  const [activeTab, setActiveTab] = useState('reciente');
  const [scrolled, setScrolled] = useState(false);
  const [currentPhotoIndex, setCurrentPhotoIndex] = useState(0);
  const [isCvModalOpen, setIsCvModalOpen] = useState(false);

  const photos = [davidGomezPhoto, david1, david2];

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentPhotoIndex((prev) => (prev + 1) % photos.length);
    }, 4000);
    return () => clearInterval(timer);
  }, [photos.length]);

  const data = {
    nombre: "David Gómez Barragán",
    titulo: "Ingeniero Civil",
    contacto: {
      tel: "5532498675",
      email: "d-gomex@soporteindustrialdelnorte.com",
      ubicacion: "México / CDMX",
      linkedin: "linkedin.com/in/david-gomez-barragan-a6503b37a/",
      web: "www.david-gomez.com"
    },
    experiencia: [
      {
        id: 'reciente',
        categoria: 'Actual',
        empresa: "Soporte Industrial del Norte Fuerza y Procesos",
        puesto: "Responsable de Operaciones",
        periodo: "Enero 2025 - Actualidad",
        descripcion: "Encargado de Construcción, Diseño, Proyectos, Compras, Facturación, Equipos e Instalaciones.",
        proyectos: [
          "Remodelación Oficinas Afore Banamex San Luis Potosí",
          "Sistemas Eléctricos Suc. Banamex Cd. Juárez",
          "Remodelación Suc. Banamex Altamira",
          "Suc. Banamex Antigua Estación Jojutla",
          "Suc. Banamex Felipe Ángeles Pachuca",
          "CEDIS SIGMA Parque Industrial IX Querétaro"
        ]
      },
      {
        id: 'infraestructura',
        categoria: 'Infraestructura',
        empresa: "Concretos Cruz Azul / GMI / Grupo Modelo",
        puesto: "Coordinador / Director de Proyectos",
        periodo: "2007 - 2010",
        descripcion: "Liderazgo en obras de gran escala y colados masivos.",
        proyectos: [
          "Senado de la República",
          "HSBC Coyoacán",
          "2do Piso Periférico (Satélite a La Quebrada)",
          "Corporativo AXA Santa Fe",
          "Museo de Ciencias e Industria Modelo Toluca (15,000 m²)",
          "Naves Industriales Walmart México"
        ]
      },
      {
        id: 'edificacion',
        categoria: 'Edificación',
        empresa: "Grupo Lumak / Meidat / Grupo Ancud",
        puesto: "Jefe de Proyectos / Construcción",
        periodo: "2001 - 2016",
        descripcion: "Especialista en remodelación comercial y residencial de alto nivel.",
        proyectos: [
          "Remodelación Club France de México",
          "Desarrollo Punta Mita Starbucks Sheraton",
          "Base Naval Isla Guadalupe",
          "Hospital General Puerto Vallarta",
          "Hospital General Landa de Matamoros"
        ]
      }
    ],
    educacion: [
      { year: "2023", title: "Especialidad en Valuación de Bienes Inmuebles", school: "ESIA - IPN" },
      { year: "1992", title: "Licenciatura en Ingeniería Civil", school: "ESIA - IPN" },
      { year: "1987", title: "Técnico en Construcción", school: "CECYT Wilfrido Massieu" }
    ],
    aptitudes: [
      { name: "Conciliador", icon: <Users className="w-5 h-5" /> },
      { name: "Analítico", icon: <Search className="w-5 h-5" /> },
      { name: "Organizador", icon: <Award className="w-5 h-5" /> },
      { name: "Liderazgo", icon: <Briefcase className="w-5 h-5" /> }
    ]
  };

  return (
    <div className="min-h-screen bg-[#fafafa] text-slate-900 font-sans selection:bg-indigo-100">
      {/* Navbar Minimalista */}
      <nav className={`fixed w-full z-50 transition-all duration-300 px-6 md:px-12 py-4 ${scrolled ? 'bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm' : 'bg-transparent'}`}>
        <div className="max-w-7xl mx-auto flex justify-between items-center">
          <span className="font-bold tracking-tighter text-xl uppercase italic text-indigo-700">DG.Civil</span>
          <div className="hidden md:flex space-x-8 text-xs font-bold uppercase tracking-widest text-slate-500 items-center">
            <a href="#experiencia" className="hover:text-indigo-600 transition-colors">Trayectoria</a>
            <a href="#proyectos" className="hover:text-indigo-600 transition-colors">Portafolio</a>
            <a href="#educacion" className="hover:text-indigo-600 transition-colors">Formación</a>
            <a href="#contacto" className="hover:text-indigo-600 transition-colors">Contacto</a>
            <a href="/admin/login" className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-slate-900 transition-all">Ingresa</a>
          </div>
        </div>
      </nav>

      {/* Hero Section */}
      <header className="relative pt-32 pb-20 md:pt-48 md:pb-32 px-6 overflow-hidden">
        <div className="absolute top-0 right-0 w-1/2 h-full bg-slate-50 -z-10 translate-x-1/4 skew-x-12 opacity-50"></div>
        <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
          <div className="order-2 md:order-1">
            <h2 className="text-indigo-600 font-bold tracking-[0.3em] uppercase text-sm mb-4">Ingeniero Civil</h2>
            <h1 className="text-6xl md:text-8xl font-black text-slate-900 leading-none mb-8 uppercase tracking-tighter">
              David <br /> Gómez <br /> <span className="text-transparent border-t-4 border-slate-900 pt-2" style={{ WebkitTextStroke: '1px #0f172a' }}>Barragán</span>
            </h1>
            <p className="text-xl text-slate-500 max-w-lg leading-relaxed mb-10 border-l-4 border-indigo-600 pl-6 italic">
              "Profesionista el 100% de mi tiempo, creciendo en todo momento. Viviendo."
            </p>
            <div className="flex flex-wrap gap-4">
              <a href="#contacto" className="bg-slate-900 text-white px-8 py-4 rounded-full font-bold text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-slate-200">
                Contactar
              </a>
              <div className="flex space-x-2">
                <div className="p-4 bg-white border border-slate-200 rounded-full hover:border-indigo-600 transition-colors cursor-pointer">
                  <Linkedin className="w-5 h-5 text-slate-600" />
                </div>
                <div className="p-4 bg-white border border-slate-200 rounded-full hover:border-indigo-600 transition-colors cursor-pointer">
                  <Globe className="w-5 h-5 text-slate-600" />
                </div>
              </div>
            </div>
          </div>
          
          <div className="order-1 md:order-2 flex justify-center md:justify-end">
            <div className="relative">
              <div className="absolute -inset-4 border-2 border-indigo-100 rounded-[3rem] -rotate-6"></div>
              <div className="relative w-72 h-96 md:w-80 md:h-[30rem] bg-slate-200 rounded-[2.5rem] shadow-2xl flex items-center justify-center overflow-hidden border-4 border-white">
                {photos.map((photo, index) => (
                  <img
                    key={index}
                    src={photo}
                    alt={`Ing. David Gómez ${index + 1}`}
                    className={`absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ${index === currentPhotoIndex ? 'opacity-100' : 'opacity-0'}`}
                  />
                ))}
              </div>
            </div>
          </div>
        </div>
      </header>

      {/* Stats Quick View */}
      <section className="bg-white py-12 border-y border-slate-100">
        <div className="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
          {[
            { label: 'Años Exp.', val: '30+' },
            { label: 'Proyectos', val: '100+' },
            { label: 'Especialidades', val: '4' },
            { label: 'Empresas', val: '15+' }
          ].map((s, i) => (
            <div key={i} className="text-center md:border-r border-slate-100 last:border-0">
              <div className="text-3xl font-black text-indigo-600 mb-1">{s.val}</div>
              <div className="text-[10px] font-bold uppercase tracking-widest text-slate-400">{s.label}</div>
            </div>
          ))}
        </div>
      </section>

      {/* Trayectoria Interactiva */}
      <section id="experiencia" className="py-24 px-6 bg-slate-50">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div className="max-w-2xl">
              <h2 className="text-xs font-black uppercase tracking-[0.4em] text-indigo-600 mb-4">Trayectoria Profesional</h2>
              <h3 className="text-4xl font-bold text-slate-900 leading-tight">Experiencia y Responsabilidad en Grandes Obras</h3>
            </div>
            <div className="flex bg-white p-1 rounded-2xl shadow-sm border border-slate-200">
              {data.experiencia.map(cat => (
                <button
                  key={cat.id}
                  onClick={() => setActiveTab(cat.id)}
                  className={`px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all ${activeTab === cat.id ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-indigo-600'}`}
                >
                  {cat.categoria}
                </button>
              ))}
            </div>
          </div>

          <div className="grid md:grid-cols-12 gap-12">
            <div className="md:col-span-5 space-y-8">
              {data.experiencia.filter(e => e.id === activeTab).map(exp => (
                <div key={exp.id} className="bg-white p-10 rounded-[2rem] shadow-sm border border-slate-100 animate-in fade-in slide-in-from-left-4 duration-500">
                  <div className="inline-block px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6">
                    {exp.periodo}
                  </div>
                  <h4 className="text-2xl font-bold mb-2 text-slate-900">{exp.puesto}</h4>
                  <p className="text-indigo-600 font-bold mb-6 text-sm">{exp.empresa}</p>
                  <p className="text-slate-500 leading-relaxed text-sm mb-8">
                    {exp.descripcion}
                  </p>
                  <div className="p-6 bg-slate-900 rounded-2xl text-white">
                    <Quote className="w-8 h-8 text-indigo-400 mb-4 opacity-50" />
                    <p className="text-sm italic font-medium">
                      “No intentes ser el mejor de tu equipo, haz que tu equipo sea el mejor”
                    </p>
                  </div>
                </div>
              ))}
            </div>

            <div className="md:col-span-7">
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {data.experiencia.find(e => e.id === activeTab).proyectos.map((pro, idx) => (
                  <div key={idx} className="bg-white p-6 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-xl transition-all group animate-in zoom-in-95 duration-300">
                    <div className="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors">
                      <ChevronRight className="w-5 h-5 text-slate-300 group-hover:text-white" />
                    </div>
                    <h5 className="font-bold text-sm text-slate-800 leading-snug">{pro}</h5>
                    <p className="text-[10px] text-slate-400 mt-2 uppercase tracking-tighter">Proyecto Finalizado</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Galería de Proyectos Dinámica */}
      <ProjectsGallery />

      {/* Formación y Aptitudes */}
      <section id="educacion" className="py-24 px-6 bg-white">
        <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-24">
          <div>
            <h3 className="text-3xl font-black mb-12 uppercase tracking-tighter italic">Formación Académica</h3>
            <div className="space-y-12">
              {data.educacion.map((edu, idx) => (
                <div key={idx} className="relative pl-12 border-l-2 border-slate-100 group">
                  <div className="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-indigo-600 border-4 border-white shadow-sm group-hover:scale-150 transition-transform"></div>
                  <span className="text-indigo-600 font-black text-2xl opacity-20 block mb-2">{edu.year}</span>
                  <h4 className="font-bold text-lg text-slate-900 mb-1">{edu.title}</h4>
                  <p className="text-sm text-slate-500 font-medium uppercase tracking-widest">{edu.school}</p>
                </div>
              ))}
            </div>
          </div>

          <div>
            <h3 className="text-3xl font-black mb-12 uppercase tracking-tighter italic text-right md:text-left">Aptitudes Clave</h3>
            <div className="grid grid-cols-2 gap-6">
              {data.aptitudes.map((skill, idx) => (
                <div key={idx} className="p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-white hover:shadow-2xl transition-all cursor-default text-center">
                  <div className="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-indigo-100">
                    {skill.icon}
                  </div>
                  <span className="font-bold text-slate-800 uppercase tracking-widest text-[10px]">{skill.name}</span>
                </div>
              ))}
            </div>
            
            <div className="mt-12 p-10 bg-gradient-to-br from-slate-900 to-indigo-900 rounded-[2.5rem] text-white">
              <h4 className="font-bold mb-4 uppercase tracking-widest text-indigo-300 text-xs text-center">Visión Personal</h4>
              <p className="text-sm leading-relaxed text-slate-300 italic text-center">
                "Valoro mucho lo aprendido día a día, se reconocer a quien me aporta experiencia y buenas nuevas ideas, creo que la gente se le debe dar siempre la oportunidad de crecer."
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Footer / Contacto */}
      <footer id="contacto" className="bg-slate-900 py-20 px-6 text-white overflow-hidden relative">
        <div className="absolute bottom-0 right-0 p-20 opacity-5 pointer-events-none">
          <Briefcase size={400} />
        </div>
        
        <div className="max-w-7xl mx-auto relative z-10">
          <div className="grid md:grid-cols-2 gap-20 items-center">
            <div>
              <h2 className="text-4xl font-black uppercase mb-8 leading-tight tracking-tighter">
                ¿Construimos el <br /> <span className="text-indigo-400">futuro juntos?</span>
              </h2>
              <div className="space-y-6">
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center"><Phone className="w-5 h-5 text-indigo-400" /></div>
                  <div>
                    <p className="text-[10px] uppercase font-bold text-slate-500 tracking-widest">Llamada Directa</p>
                    <p className="font-bold">{data.contacto.tel}</p>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center"><Mail className="w-5 h-5 text-indigo-400" /></div>
                  <div className="truncate overflow-hidden max-w-xs md:max-w-none">
                    <p className="text-[10px] uppercase font-bold text-slate-500 tracking-widest">Email Corporativo</p>
                    <p className="font-bold truncate">{data.contacto.email}</p>
                  </div>
                </div>
                <div className="flex items-center space-x-4">
                  <div className="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center"><MapPin className="w-5 h-5 text-indigo-400" /></div>
                  <div>
                    <p className="text-[10px] uppercase font-bold text-slate-500 tracking-widest">Ubicación</p>
                    <p className="font-bold">{data.contacto.ubicacion}</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="bg-white/5 backdrop-blur-xl p-10 rounded-[3rem] border border-white/10">
              <h4 className="text-lg font-bold mb-6">Enlaces de Interés</h4>
              <div className="grid gap-4">
                <a href={`https://${data.contacto.linkedin}`} className="flex justify-between items-center p-4 bg-white/5 rounded-2xl hover:bg-indigo-600 transition-all group">
                  <span className="font-bold text-sm">LinkedIn Perfil</span>
                  <ExternalLink className="w-4 h-4 opacity-50 group-hover:opacity-100" />
                </a>
                <a href="#" className="flex justify-between items-center p-4 bg-white/5 rounded-2xl hover:bg-indigo-600 transition-all group">
                  <span className="font-bold text-sm">Sitio Web Personal</span>
                  <ExternalLink className="w-4 h-4 opacity-50 group-hover:opacity-100" />
                </a>
                <button 
                  onClick={() => setIsCvModalOpen(true)}
                  className="w-full flex justify-between items-center p-4 bg-white/5 rounded-2xl hover:bg-indigo-600 transition-all group"
                >
                  <span className="font-bold text-sm">Descargar CV PDF</span>
                  <ExternalLink className="w-4 h-4 opacity-50 group-hover:opacity-100" />
                </button>
              </div>
            </div>
          </div>

          <div className="mt-20 pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-slate-500 text-xs font-bold uppercase tracking-widest">
            <span>© {new Date().getFullYear()} Ing. David Gómez Barragán</span>
            <span className="italic">Innovación en Ingeniería Civil</span>
            <div className="flex space-x-6">
              <span className="hover:text-white cursor-pointer transition-colors">Aviso de Privacidad</span>
              <span className="hover:text-white cursor-pointer transition-colors">Términos</span>
            </div>
          </div>
        </div>
      </footer>

      {/* Modal de CV */}
      {isCvModalOpen && (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm animate-in fade-in duration-300">
          <div className="relative w-full max-w-5xl h-[90vh] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col">
            <div className="p-4 border-b border-slate-100 flex justify-between items-center bg-white">
              <div className="flex items-center space-x-3">
                <div className="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                  <FileText className="w-5 h-5" />
                </div>
                <div>
                  <h4 className="font-bold text-slate-900">CV David Gómez Barragán</h4>
                  <p className="text-[10px] text-slate-400 uppercase tracking-widest font-black">Documento Oficial PDF</p>
                </div>
              </div>
              <div className="flex items-center space-x-2">
                <a 
                  href="/cv-david-gomez.pdf" 
                  download 
                  className="p-3 hover:bg-slate-50 rounded-xl transition-colors text-slate-400 hover:text-indigo-600"
                  title="Descargar"
                >
                  <Download className="w-5 h-5" />
                </a>
                <button 
                  onClick={() => setIsCvModalOpen(false)} 
                  className="p-3 hover:bg-slate-50 rounded-xl transition-colors text-slate-400 hover:text-red-500"
                >
                  <X className="w-5 h-5" />
                </button>
              </div>
            </div>
            <div className="flex-1 bg-slate-50">
              <iframe 
                src="/cv-david-gomez.pdf" 
                className="w-full h-full border-0"
                title="CV PDF"
              />
            </div>
          </div>
        </div>
      )}
      <Chatbot />
    </div>
  );
};

export default App;