<template>
  <app-layout>
    <v-container>
      <v-row>
        <v-col cols="12" xs="12" sm="12" md="12" lg="12">
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="mx-2"
                fab
                dark
                color="indigo"
                @click="$store.commit('crearProyectoModal', true)"
                v-bind="attrs"
                v-on="on"
              >
                <v-icon dark> mdi-plus </v-icon>
              </v-btn>
            </template>
            <span>Crear Proyecto</span>
          </v-tooltip>
        </v-col>
        <v-col
          cols="12"
          xs="12"
          sm="12"
          md="4"
          lg="4"
          v-for="(proyecto, p) in proyectos"
          :key="p"
        >
          <v-card width="400">
            <v-img height="200px" src="">
              <v-app-bar flat color="rgba(0, 0, 0, 0)">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on, attrs }">
                    <v-toolbar-title
                      class="title red--text pl-0"
                      v-bind="attrs"
                      v-on="on"
                    >
                      {{ proyecto.proyecto_nombre }}
                    </v-toolbar-title>
                  </template>
                  <span> {{ proyecto.proyecto_nombre }}</span>
                </v-tooltip>
                <v-spacer></v-spacer>
                <v-menu bottom left>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn icon v-bind="attrs" v-on="on">
                      <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-item>
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                          <v-list-item-title v-bind="attrs" v-on="on">
                            <v-btn
                              color="warning"
                              icon
                              small
                              @click="EditarProyecto(proyecto)"
                              ><v-icon>mdi-pencil</v-icon></v-btn
                            >
                          </v-list-item-title>
                        </template>
                        <span> Editar</span>
                      </v-tooltip>
                    </v-list-item>
                    <v-list-item>
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                          <v-list-item-title v-bind="attrs" v-on="on">
                            <v-btn color="primary" icon small
                              ><v-icon>mdi-file-document-multiple-outline</v-icon></v-btn
                            >
                          </v-list-item-title>
                        </template>
                        <span> Documentos</span>
                      </v-tooltip>
                    </v-list-item>
                    <v-list-item>
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                          <v-list-item-title v-bind="attrs" v-on="on">
                            <jet-nav-link
                              :href="route('historia')"
                              :active="route().current('historia')"
                            >
                              <v-btn color="info" icon small
                                ><v-icon>mdi-timeline-clock-outline</v-icon></v-btn
                              >
                            </jet-nav-link>
                          </v-list-item-title>
                        </template>
                        <span> Historial</span>
                      </v-tooltip>
                    </v-list-item>
                    <v-list-item>
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                          <v-list-item-title v-bind="attrs" v-on="on">
                             <jet-nav-link
                              :href="route('configurar.proyecto', { proyecto: proyecto.proyecto_nombre })"
                              :active="route().current('configurar.proyecto')"
                              
                            >
                                <v-btn color="info" icon small @click="configurarProyecto(proyecto)"><v-icon>mdi-cog-outline</v-icon></v-btn
                            >
                            </jet-nav-link>
                          </v-list-item-title>
                        </template>
                        <span>Configurar Proyecto</span>
                      </v-tooltip>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </v-app-bar>

              <!-- <v-card-title class="white--text mt-8">
                <v-avatar size="56">
                  <img
                    alt="user"
                    src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
                  />
                </v-avatar>
                <p class="ml-3">John Doe</p>
              </v-card-title> -->

              <v-alert
                text
                prominent
                type="warning"
                icon="mdi-projector-screen"
                v-if="proyecto.estado_proyecto"
              >
                <h3 class="headline">
                  <span>Proyecto Iniciado</span>
                </h3>
                <div>
                  <v-progress-linear
                    color="red lighten-2"
                    buffer-value="0"
                    stream
                  ></v-progress-linear>
                </div>
              </v-alert>
              <v-btn
                color="success"
                class="mt-20 mr-5 float-right"
                @click="iniciarProyecto(proyecto)"
                v-else
                >Iniciar Proyecto <v-icon>mdi-run</v-icon></v-btn
              >
            </v-img>
            <v-card-text>
              <div class="font-weight-bold ml-8 mb-2">Historia</div>
              <v-timeline align-top dense>
                <v-timeline-item
                  v-for="(history, h) in proyecto.has_history"
                  :key="h"
                  small
                >
                  <div>
                    <div class="font-weight-normal">
                      <strong>{{ history.descripcion_history }}</strong>
                      @{{ history.created_at.substr(0, 10) }}
                    </div>
                    <!-- <div>{{ message.message }}</div> -->
                  </div>
                </v-timeline-item>
              </v-timeline>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <modal-crear />
    <modal-editar />
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import createProyectoModal from "./Modals/crearProyectoModal";
import ediarProyectoModal from "./Modals/editProyectoModal";
import JetNavLink from "@/Jetstream/NavLink";
import { mapGetters } from "vuex";
export default {
  props: {
    data: {
      type: Array,
    },
  },
  data() {
    return {
      messages: [
        {
          from: "You",
          message: `Sure, I'll see you later.`,
          time: "10:42am",
          color: "deep-purple lighten-1",
        },
        {
          from: "John Doe",
          message: "Yeah, sure. Does 1:00pm work?",
          time: "10:37am",
          color: "green",
        },
        {
          from: "You",
          message: "Did you still want to grab lunch today?",
          time: "9:47am",
          color: "deep-purple lighten-1",
        },
      ],
      items: [
        { title: "Click Me" },
        { title: "Click Me" },
        { title: "Click Me" },
        { title: "Click Me 2" },
      ],
      model: {
        var_inicio_proyecto: "Proyecto iniciado",
      },
    };
  },
  components: {
    AppLayout,
    "modal-crear": createProyectoModal,
    "modal-editar": ediarProyectoModal,
    JetNavLink,
  },
  computed: {
    ...mapGetters(["services", "proyectos"]),
  },
  mounted() {
    this.services.ProyectoServices.get();
  },
  methods: {
    async EditarProyecto(proyecto) {
      try {
        this.$store.commit("setProyecto", proyecto);
        this.$store.commit("editarProyectoModal", true);
      } catch (e) {
        console.log(e);
      }
    },
    async iniciarProyecto(proyecto) {
      try {
        this.services.ProyectoServices.putEstadoProyecto(this.model, proyecto);
        this.services.ProyectoServices.get();
      } catch (e) {
        console.log(e);
      }
    },
    configurarProyecto(proyecto){
      this.$store.commit('setProyecto', proyecto);
    }
  },
};
</script>
