import ProyectoServices from './servicesModels/ProyectoServices'
import HistoryServices from './servicesModels/HistoryServices'
import UserServices from './servicesModels/UserServices'
export default {
    ProyectoServices: new ProyectoServices(),
    HistoryServices: new HistoryServices(),
    UserServices: new UserServices(),
}