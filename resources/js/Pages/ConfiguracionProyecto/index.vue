<template>
  <app-layout>
    <div class="p-5">
      <v-card>
        <v-toolbar flat color="primary" dark>
          <v-toolbar-title
            >Configuracion del proyecto {{ route().params.proyecto }}</v-toolbar-title
          >
        </v-toolbar>
        <v-tabs vertical>
          <v-tab>
            <v-icon left> mdi-account </v-icon>
            Seleccion de Participantes
          </v-tab>
          <v-tab>
            <v-icon left> mdi-lock </v-icon>
            Option 2
          </v-tab>
          <v-tab>
            <v-icon left> mdi-access-point </v-icon>
            Option 3
          </v-tab>
          <v-tab-item>
            <v-card flat>
              <v-card-text>
                <v-row>
                  <v-col col="12" xs="12" sm="12" md="12" lg="12">
                    <v-btn color="success" @click="iniciarProcesoDeSeleccion" >Inicio del proceso de seleccion
                      <v-icon>mdi-account-circle-outline</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
                <v-row justify="space-around">
                  <v-col col="12" xs="12" sm="12" md="4" lg="4">
                    <v-card max-width="450">
                      <v-card-title>Supervivor</v-card-title>
                      <template slot="progress">
                        <v-progress-linear
                          color="deep-purple"
                          height="10"
                          indeterminate
                        ></v-progress-linear>
                      </template>
                      <img
                        height="250"
                        src="https://img.icons8.com/dotty/250/000000/user-folder.png"
                      />
                      <v-divider class="mx-4"></v-divider>
                      <v-card-title>Participantes</v-card-title>
                         <v-autocomplete
                            :items="users"
                            item-text="name"
                            item-key="id"
                            return-object
                            outlined
                            label="Seleccionar Candidato"
                            v-model="model_data.candidato"
                          ></v-autocomplete>
                      <v-divider class="mx-4"></v-divider>
                      <v-card-text>
                        <div>
                          <v-textarea
                            outlined
                            name="input-7-4"
                            label="Descripcion"
                            v-model="model_data.descripcion"
                          ></v-textarea>
                        </div>
                      </v-card-text>

                      <v-divider class="mx-4"></v-divider>
                       <v-card-title>Fechas Limites</v-card-title>
                      <v-row>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu1s"
                            v-model="menu1s"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormatteds"
                                label="Fecha de Inicio"
                                persistent-hint
                               append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="dates = parseDate(dateFormatteds)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="dates"
                              no-title
                              @input="menu1s = false"
                            ></v-date-picker>
                          </v-menu>
                          
                        </v-col>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu2s"
                            v-model="menu2s"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormatted1s"
                                label="Fecha de Limite"
                                persistent-hint
                                append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="date1s = parseDate(dateFormatted1s)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="date1s"
                              no-title
                              @input="menu2s = false"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>
                      </v-row>
                      <v-divider class="mx-4"></v-divider>

                      <v-card-title>Documentos Requeridos</v-card-title>

                      <v-card-text>
                        <v-row>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-text-field
                              label="Documento"
                              append-icon="mdi-file-document-outline"
                              outlined
                              v-model="documento.documento"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-textarea
                              outlined
                              label="Descripcion"
                              v-model="documento.descripcion"
                            ></v-textarea>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-btn color="success" block @click="cargarRequisitos" >Cargar Requisito</v-btn>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12"  >
                              <v-list
                                subheader
                                three-line

                              >
                                <v-list-item v-for="(doc, d) in documentos_requeridos.supervisor" :key="d" >
                                  <v-list-item-content v-if="Object.entries(documentos_requeridos.supervisor).length > 0">
                                    <v-list-item-title>{{doc.documento}}</v-list-item-title>
                                    <v-list-item-subtitle>{{doc.descripcion}}</v-list-item-subtitle>
                                  </v-list-item-content>
                                </v-list-item>
                              </v-list>
                          </v-col>
                        </v-row>
                      </v-card-text>
                      <v-card-actions>
                        <v-btn color="deep-purple lighten-2" text @click="GuardarSupervisor" > Guardar </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-col>
                  <v-col col="12" xs="12" sm="12" md="4" lg="4">
                    <v-card max-width="450">
                      <v-card-title>Interventor</v-card-title>
                      <template slot="progress">
                        <v-progress-linear
                          color="deep-purple"
                          height="10"
                          indeterminate
                        ></v-progress-linear>
                      </template>
                      <img
                        height="250"
                        src="https://img.icons8.com/dotty/250/000000/user-folder.png"
                      />
                      <v-divider class="mx-4"></v-divider>
                      <v-card-title>Participantes</v-card-title>
                         <v-autocomplete
                            :items="users"
                            item-text="name"
                            item-key="id"
                            return-object
                            outlined
                            label="Seleccionar Candidato"
                            v-model="model_data_interventor.candidato"
                          ></v-autocomplete>
                      <v-divider class="mx-4"></v-divider>
                      <v-card-text>
                        <div>
                          <v-textarea
                            outlined
                            name="input-7-4"
                            label="Descripcion"
                            v-model="model_data_interventor.descripcion"
                          ></v-textarea>
                        </div>
                      </v-card-text>

                      <v-divider class="mx-4"></v-divider>
                       <v-card-title>Fechas Limites</v-card-title>
                      <v-row>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu1i"
                            v-model="menu1i"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormattedi"
                                label="Fecha de Inicio"
                                persistent-hint
                               append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="datei = parseDate(dateFormattedi)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="datei"
                              no-title
                              @input="menu1i = false"
                            ></v-date-picker>
                          </v-menu>
                          
                        </v-col>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu2i"
                            v-model="menu2i"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormatted1i"
                                label="Fecha de Limite"
                                persistent-hint
                                append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="date1i = parseDate(dateFormatted1i)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="date1i"
                              no-title
                              @input="menu2i = false"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>
                      </v-row>
                      <v-divider class="mx-4"></v-divider>

                      <v-card-title>Documentos Requeridos</v-card-title>

                      <v-card-text>
                        <v-row>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-text-field
                              label="Documento"
                              append-icon="mdi-file-document-outline"
                              outlined
                              v-model="documentoi.documento"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-textarea
                              outlined
                              label="Descripcion"
                              v-model="documentoi.descripcion"
                            ></v-textarea>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-btn color="success" block @click="cargarRequisitosi" >Cargar Requisito</v-btn>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12"  >
                              <v-list
                                subheader
                                three-line

                              >
                                <v-list-item v-for="(doc, d) in documentos_requeridos.interventor" :key="d" >
                                  <v-list-item-content v-if="Object.entries(documentos_requeridos.interventor).length > 0">
                                    <v-list-item-title>{{doc.documento}}</v-list-item-title>
                                    <v-list-item-subtitle>{{doc.descripcion}}</v-list-item-subtitle>
                                  </v-list-item-content>
                                </v-list-item>
                              </v-list>
                          </v-col>
                        </v-row>
                      </v-card-text>
                      <v-card-actions>
                        <v-btn color="deep-purple lighten-2" text @click="GuardarInterventor" > Guardar </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-col>
                  <v-col col="12" xs="12" sm="12" md="4" lg="4">
                    <v-card max-width="450">
                      <v-card-title>Contratista</v-card-title>
                      <template slot="progress">
                        <v-progress-linear
                          color="deep-purple"
                          height="10"
                          indeterminate
                        ></v-progress-linear>
                      </template>
                      <img
                        height="250"
                        src="https://img.icons8.com/dotty/250/000000/user-folder.png"
                      />
                      <v-divider class="mx-4"></v-divider>
                      <v-card-title>Participantes</v-card-title>
                         <v-autocomplete
                            :items="users"
                            item-text="name"
                            item-key="id"
                            return-object
                            outlined
                            label="Seleccionar Candidato"
                            v-model="model_data_contratista.candidato"
                          ></v-autocomplete>
                      <v-divider class="mx-4"></v-divider>
                      <v-card-text>
                        <div>
                          <v-textarea
                            outlined
                            name="input-7-4"
                            label="Descripcion"
                            v-model="model_data_contratista.descripcion"
                          ></v-textarea>
                        </div>
                      </v-card-text>

                      <v-divider class="mx-4"></v-divider>
                       <v-card-title>Fechas Limites</v-card-title>
                      <v-row>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu1c"
                            v-model="menu1c"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormattedc"
                                label="Fecha de Inicio"
                                persistent-hint
                               append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="datec = parseDate(dateFormattedc)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="datec"
                              no-title
                              @input="menu1c = false"
                            ></v-date-picker>
                          </v-menu>
                          
                        </v-col>
                        <v-col col="12" xs="12" sm="12" md="6" lg="6">
                          <v-menu
                            ref="menu2c"
                            v-model="menu2c"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="auto"
                            outlined
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormatted1c"
                                label="Fecha de Limite"
                                persistent-hint
                                append-icon="mdi-calendar"
                                v-bind="attrs"
                                @blur="date1c = parseDate(dateFormatted1c)"
                                v-on="on"
                                outlined
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="date1c"
                              no-title
                              @input="menu2c = false"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>
                      </v-row>
                      <v-divider class="mx-4"></v-divider>

                      <v-card-title>Documentos Requeridos</v-card-title>

                      <v-card-text>
                        <v-row>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-text-field
                              label="Documento"
                              append-icon="mdi-file-document-outline"
                              outlined
                              v-model="documentoc.documento"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-textarea
                              outlined
                              label="Descripcion"
                              v-model="documentoc.descripcion"
                            ></v-textarea>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12">
                            <v-btn color="success" block @click="cargarRequisitosc" >Cargar Requisito</v-btn>
                          </v-col>
                          <v-col cols="12" xs="12" sm="12" md="12" lg="12"  >
                              <v-list
                                subheader
                                three-line

                              >
                                <v-list-item v-for="(doc, d) in documentos_requeridos.contratista" :key="d" >
                                  <v-list-item-content v-if="Object.entries(documentos_requeridos.contratista).length > 0">
                                    <v-list-item-title>{{doc.documento}}</v-list-item-title>
                                    <v-list-item-subtitle>{{doc.descripcion}}</v-list-item-subtitle>
                                  </v-list-item-content>
                                </v-list-item>
                              </v-list>
                          </v-col>
                        </v-row>
                      </v-card-text>
                      <v-card-actions>
                        <v-btn color="deep-purple lighten-2" text @click="GuardarContratista" > Guardar </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>
          </v-tab-item>
          <v-tab-item>
            <v-card flat>
              <v-card-text>
                <p>
                  Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas,
                  lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed
                  mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non
                  adipiscing dolor urna a orci. Curabitur ligula sapien, tincidunt non,
                  euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                </p>

                <p>
                  Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas,
                  lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin
                  viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien,
                  a accumsan nisi mauris ac eros. In hac habitasse platea dictumst. Fusce
                  ac felis sit amet ligula pharetra condimentum.
                </p>

                <p>
                  Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis
                  gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer
                  turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                </p>

                <p>
                  Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt
                  libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec
                  arcu.
                </p>

                <p class="mb-0">
                  Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui
                  magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo
                  aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a,
                  condimentum nec, nisi.
                </p>
              </v-card-text>
            </v-card>
          </v-tab-item>
          <v-tab-item>
            <v-card flat>
              <v-card-text>
                <p>
                  Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam
                  eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu
                  tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere
                  eget, vestibulum et, tempor auctor, justo.
                </p>

                <p class="mb-0">
                  Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin
                  sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis,
                  ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in
                  tellus interdum sagittis.
                </p>
              </v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs>
      </v-card>
    </div class="p-5">
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import JetNavLink from "@/Jetstream/NavLink";
import { mapGetters } from "vuex";
export default {
  components: {
    AppLayout,
    JetNavLink,
  },
  data() {
    return {
      // supervisor
      dates: new Date().toISOString().substr(0, 10),
      dateFormatteds: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu1s: false,

      date1s: new Date().toISOString().substr(0, 10),
      dateFormatted1s: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu2s: false,

      // interventor
      datei: new Date().toISOString().substr(0, 10),
      dateFormattedi: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu1i: false,

      date1i: new Date().toISOString().substr(0, 10),
      dateFormatted1i: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu2i: false,

      //contratista
      datec: new Date().toISOString().substr(0, 10),
      dateFormattedc: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu1c: false,

      date1c: new Date().toISOString().substr(0, 10),
      dateFormatted1c: this.formatDate(new Date().toISOString().substr(0, 10)),
      menu2c: false,


      documentos_requeridos:{
        supervisor:[],
        interventor:[],
        contratista:[]
      },
      documento:{
        documento: '',
        descripcion: '',
      },
      documentoi:{
        documento: '',
        descripcion: '',
      },
      documentoc:{
        documento: '',
        descripcion: '',
      },
      model: {
        var_inicio_proyecto: "Proceso de seleccion iniciado",
      },
      model_data:{
        candidato: {},
        descripcion: '',
      },
      model_data_interventor:{
        candidato: {},
        descripcion: '',
      },
      model_data_contratista:{
        candidato: {},
        descripcion: '',
      },

    };
  },
  computed: {
    ...mapGetters(['services', 'proyecto','users']),
   
  },
  watch: {
    dates(val) {
      this.dateFormatteds = this.formatDate(this.dates);
    },
    date1s(val) {
      this.dateFormatted1s = this.formatDate(this.date1s);
    },
    datei(val) {
      this.dateFormattedi = this.formatDate(this.datei);
    },
    date1i(val) {
      this.dateFormatted1i = this.formatDate(this.date1i);
    },
    datec(val) {
      this.dateFormattedc = this.formatDate(this.datec);
    },
    date1c(val) {
      this.dateFormatted1c = this.formatDate(this.date1c);
    },
  },
  mounted() {
    this.services.UserServices.get()
  },
  methods: {
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${month}/${day}/${year}`;
    },
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    cargarRequisitos(){
      this.documentos_requeridos.supervisor.push(this.documento)
      this.documento = {
        documento: '',
        descripcion: '',
      }
    },
    cargarRequisitosi(){
      this.documentos_requeridos.interventor.push(this.documentoi)
      this.documentoi = {
        documento: '',
        descripcion: '',
      }
    },
    cargarRequisitosc(){
      this.documentos_requeridos.contratista.push(this.documentoc)
      this.documentoc = {
        documento: '',
        descripcion: '',
      }
    },
    iniciarProcesoDeSeleccion(){
      this.services.ProyectoServices.putEstadoProyecto(this.model, this.proyecto);
    },
    async GuardarSupervisor(){
      var model = {
        candidato : this.model_data.candidato,
        descripcion: this.model_data.descripcion,
        f_inicio: this.dates,
        f_final: this.date1s,
        requisitos: this.documentos_requeridos.supervisor,
        proyecto: this.proyecto
      }
       this.services.ProyectoServices.guardarCandidatoSupervisor(model)
    },
    async GuardarInterventor(){
      var model = {
        candidato : this.model_data_interventor.candidato,
        descripcion: this.model_data_interventor.descripcion,
        f_inicio: this.datei,
        f_final: this.date1i,
        requisitos: this.documentos_requeridos.interventor,
        proyecto: this.proyecto
      }
       this.services.ProyectoServices.guardarCandidatoInterventor(model)
    },
    async GuardarContratista(){
      var model = {
        candidato : this.model_data_contratista.candidato,
        descripcion: this.model_data_contratista.descripcion,
        f_inicio: this.datec,
        f_final: this.date1c,
        requisitos: this.documentos_requeridos.contratista,
        proyecto: this.proyecto
      }
       this.services.ProyectoServices.guardarCandidatoContratista(model)
    },
  },
};
</script>
