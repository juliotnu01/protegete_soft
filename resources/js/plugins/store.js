import Vue from 'vue'
import Vuex from 'vuex'
import services from '../services'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
      services,
      crearProyectoModal: false,
      editarProyectoModal: false,
      proyectos: [],
      proyecto: {},
      historias: [],
      users:[],
  },
  getters:{
    services: state => state.services,
    crearProyectoModal: state => state.crearProyectoModal,
    editarProyectoModal: state => state.editarProyectoModal,
    proyectos: state => state.proyectos,
    proyecto: state => state.proyecto,
    historias: state => state.historias,
    users: state => state.users,
  },
  mutations: {
    crearProyectoModal(state, data){
      state.crearProyectoModal = data
    },
    editarProyectoModal(state, data){
      state.editarProyectoModal = data
    },
    setProyectos(state, data){
      state.proyectos = data
    },
    setProyecto(state, data){
      state.proyecto = data
    },
    setHistorias(state, data){
      state.historias = data
    },
    setUsers(state,data){
      state.users = data
    }
  }
})