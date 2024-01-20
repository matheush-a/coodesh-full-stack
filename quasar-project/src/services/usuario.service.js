import api from '../services/api.service';

export default {
  get() {
    return api.get(`/usuarios`);
  },

  getById(id) {
    return api.get(`/usuarios/${id}`);
  },

  store(user) {
    return api.post('/usuarios', user);
  },

  update(updatedUser) {
    return api.patch(`/usuarios/${updatedUser.id}`, updatedUser);
  },

  delete(id) {
    return api.delete(`/usuarios/${id}`);
  },
};