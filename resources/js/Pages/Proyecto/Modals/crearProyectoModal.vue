<template>
  <div>
    <v-dialog v-model="openModal" width="500">
      <v-card>
        <v-toolbar dense>
          <v-toolbar-title>Crear Proyecto</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon @click="openModal = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-card-text class="mt-5">
          <v-form ref="form_proyecto">
            <v-row>
              <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                <v-text-field
                  label="Nombre del Proyecto"
                  placeholder="Escriba el nombre del proyecto"
                  outlined
                  :rules="nameProyectoRules"
                  v-model="model.proyecto_nombre"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="store"> Crear Proyecto </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      nameProyectoRules: [(v) => !!v || "El nombre del proyecto es requerido"],
      model: {
        proyecto_nombre: ''
      },
    };
  },
  computed: {
    ...mapGetters(["services", "crearProyectoModal"]),
    openModal: {
      get() {
        return this.crearProyectoModal;
      },
      set(val) {
        this.$store.commit("crearProyectoModal", val);
      },
    },
  },
  methods: {
    async store(){
      try{
        if(this.$refs.form_proyecto){
          await this.services.ProyectoServices.store(this.model)
          await this.services.ProyectoServices.get()
          this.openModal = false
          this.model = {
            proyecto_nombre: ''
          }
        }
      }catch(e){
        console.log(e)
      }
    }
  },
};
</script>
