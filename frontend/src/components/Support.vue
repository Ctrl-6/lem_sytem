<template>
  <v-container grid-list-xs>
    <div class="text-center" data-app>
       
         <v-row>
      <v-col>
        <v-data-table
          :headers="headers"
          :items="instalaciones"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Instalaciones</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    @click="statusDialog=true"
                  >
                    Buscar por Status
                  </v-btn>                  
            </v-toolbar>
          </template>
          
          
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon small class="mr-2" @click="validateItem(item)"> mdi-checkbox-marked-outline </v-icon>
            <v-icon small class="mr-2" @click="showDetails(item)">   mdi-dots-grid </v-icon>
            <v-icon small class="mr-2" @click="showHistory(item)" >  mdi-clipboard-text-clock </v-icon>
            <v-icon small class="mr-2" @click="editComent(item)"> mdi-comment-text </v-icon>
             <v-icon v-if="item.Coments!=null" small class="mr-2"> mdi-checkbox-blank-circle</v-icon>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
       
       
       
  <!----------------------------------------------------------------------------------->
  <!-------------------------------- Show Status ------------------------------------->
  <!----------------------------------------------------------------------------------->
       
       <v-dialog v-model="statusDialog" width="500">        
        <v-card>
          <v-card-title class="text-h5 grey lighten-2">
            Ingrese Status
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col class="my-2" cols="12">
                  <v-select
                    v-model="statusInput"
                    :items="items"
                    label="Status"
                  ></v-select>
                 </v-col>

              </v-row>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="getFiltre(statusInput)">
              Buscar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <br />
  


  <!----------------------------------------------------------------------------------->
  <!-------------------------------- Show Details ------------------------------------->
  <!----------------------------------------------------------------------------------->
  
    <v-dialog persistent v-model="detailsDialog" max-width="500px">
      <v-card>
        <v-card-title class="text-h5 blue">
          <span class="text-h5">Detalles</span>
          </v-card-title>
          
          <v-divider class="mx-4" inset vertical></v-divider>

        <v-card-text>
            <v-form>
              <v-row>
               
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.tecnicoid"
                    :counter="10"
                    label="ID Tecnico"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
               
               
                <v-col class="my-2" cols="12">
                  <v-text-field
                    v-model="editedItem.clientid"
                    :counter="10"
                    label="ID Client"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
                
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.date"
                    :counter="10"
                    label="Fecha"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.status"
                    :counter="10"
                    label="Status"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
                
                
                
                 <v-col cols="12">
                  <v-select
                    v-model="editedItem.equipo"
                    :items="equipos"
                    label="Equipo"
                    outlined
                    readonly
                  ></v-select>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.name"
                    :counter="10"
                    label="Nombre equipo"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.nodoid"
                    :counter="10"
                    label="Nodo ID"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.position"
                    :counter="10"
                    label="Posicion"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.coordinator"
                    :counter="10"
                    label="Coordinador"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.firmwaretype"
                    :counter="10"
                    label="Tipo de Firmware"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.placatype"
                    :counter="10"
                    label="Tipo de Placa"
                   outlined
                   readonly
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.frequency"
                    :counter="10"
                    label="Frecuencia de envio"
                    outlined
                    readonly
                  ></v-text-field>
                </v-col>

              <div class="m2" v-for="(equipo, index) in equipos" :key="index">
                    <div v-if="editedItem.equipo == equipo">
                        
                      <v-col cols="12" v-if="atributesEquipos[index].includes('chipcompany')">
                        <v-text-field 
                            v-model="editedItem.chipcompany"
                            :counter="20"
                            label="Compañia de chip"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                       <v-col cols="12" v-if="atributesEquipos[index].includes('sondatype')">
                        <v-text-field 
                            v-model="editedItem.sondatype"
                            :counter="20"
                            label="Tipo de sonda"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sondalarge')">
                        <v-text-field 
                            v-model="editedItem.sondalarge"
                            :counter="20"
                            label="Largo de sonda"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>
                      
                      <v-col cols="12" v-if="atributesEquipos[index].includes('maxhigh')">
                        <v-text-field 
                            v-model="editedItem.maxhigh"
                            :counter="20"
                            label="Altura maxima"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sensorhigh')">
                        <v-text-field 
                            v-model="editedItem.sensorhigh"
                            :counter="20"
                            label="Altura de sensor"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('waterhigh')">
                        <v-text-field 
                            v-model="editedItem.waterhigh"
                            :counter="20"
                            label="Altura de agua"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('deeppool')">
                        <v-text-field 
                            v-model="editedItem.deeppool"
                            :counter="20"
                            label="Profunidad de pozo"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>


                      <v-col cols="12" v-if="atributesEquipos[index].includes('staticlevel')">
                        <v-text-field 
                             v-model="editedItem.staticlevel"
                            :counter="20"
                            label="Nivel Estatico"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('dinamiclevel')">
                        <v-text-field 
                            v-model="editedItem.dinaminclevel"
                            :counter="20"
                            label="Nivel dinamico"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('referencesensor')">
                        <v-text-field 
                             v-model="editedItem.referencesensor"
                             label="Sensor de Referencia"
                            :counter="20"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('pulses')">
                        <v-text-field 
                            v-model="editedItem.pulses"
                            :counter="20"
                            label="Pulsos"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('energytype')">
                        <v-text-field 
                            v-model="editedItem.energytype"
                            :counter="20"
                            label="Tipo de energia"
                            readonly
                            outlined
                            ></v-text-field>
                      </v-col>
                    </div>
                  </div>
                
 
              </v-row>
            </v-form>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeDetails">
            Salir
          </v-btn>

        </v-card-actions>
      </v-card>
    </v-dialog>
  
    
    

  <!----------------------------------------------------------------------------------->
  <!-------------------------------- Show Validar ------------------------------------->
  <!----------------------------------------------------------------------------------->

    <v-dialog persistent v-model="comentDialog " max-width="500px">
      <v-card>
        <v-card-title class="text-h5 blue" 
          >Comentar Instalacion</v-card-title
        >
          <v-form>
            <v-textarea
              v-model="editedItem.Coments"
              color="teal"
              label="Comentario"
              style="padding: 20px;"
            >
              <template v-slot:label>
                  Comentario
              
              </template>
            </v-textarea>   


          </v-form>
            
        
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeComent"
            >Salir</v-btn
          >
          <v-btn color="blue darken-1" text @click="putComent"
            >Comentar</v-btn
          >


          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
      </v-dialog>

  <!----------------------------------------------------------------------------------->
  <!-------------------------------- Historial --------------------------------------->
  <!----------------------------------------------------------------------------------->
<v-dialog  persistent v-model="historyDialog"  >
      <v-card class="dialogs">
        <v-row>
          <v-col>
            <v-data-table
              :headers="headers"
              :items="historial"
              class="elevation-1"
            >
              <template v-slot:top>
                <v-toolbar flat>
                  <v-toolbar-title>Historial</v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                  <v-spacer></v-spacer>
                    <v-btn
                      color="primary"
                      dark
                      @click="historyDialog=false"
                    >
                      Salir
                    </v-btn> 
                </v-toolbar>
              </template>
              
              
              <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="showDetails(item)" >  mdi-dots-grid </v-icon>
              </template>
            
            </v-data-table>
          </v-col>
        </v-row>
      </v-card>
    </v-dialog>

<!----------------------------------------------------------------------------------->
  <!-------------------------------- Validar --------------------------------------->
  <!--------------------------------------------------------------------------------->

  <v-dialog v-model="validateDialog" max-width="500px">
      <v-card>
        <v-card-title class="text-h5"
          > <center> ¿Desea validar instalacion?</center></v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeValidate"
            >Cancelar</v-btn
          >
          <v-btn color="blue darken-1" text @click="validate"
            >OK</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>




  </v-container>
</template>

<script>
import axios from "axios";

export default {
  name: "Instalations",
  data() {
    return {
      instalaciones: [],
      historial: [],

    
      statusInput: "",
      items: ["Pending", "Ready", "All"],

      equipos: [],
      atributesEquipos: [],

      statusDialog: false,
      validateDialog: false,
      historyDialog: false,
      detailsDialog: false,
      comentDialog: false,
    
       headers: [
        {
          text: "Tecnico ID",
          align: "start",
          sortable: false,
          value: "tecnicoid",
        },
        { text: "Client ID", value: "clientid",sortable: false },
        { text: "ID", value: "id",sortable: false},
        { text: "Fecha", value: "date" },
        { text: "Equipo", value: "equipo",sortable: false},
        { text: "Status", value: "status",sortable: false },
        { text: "Actions", value: "actions", sortable: false },
      ],
     
    ////////////////////////// Edited Item Objet //////////////////////////////////

      editedItem: {
        tecnicoid: "",
        clientid: "",
        date: "",
        status: "Pending",
        equipo: "",
        name: "",
        
        nodoid: "",
        position: "",
        coordinator: "",
        firmwaretype: "",
        placatype: "",
        frequency: "",
        
        chipcompany: "",
        sondatype: "",
        sondalarge: "",
        maxhigh: "",
        sensorhigh: "",
        waterhigh: "",
        deeppool: "",
        staticlevel: "",
        dinamiclevel: "",
        referencesensor: "",
        pulses: "",
        energytype: "",
          
        
        Coments: ""
      
      },

      /////////////////////////////////// Default Item Objet ///////////////////////////////////////////////
      
      defaultItem: {
       tecnicoid: "",
        clientid: "",
        date: "",
        status: "Pending",
        equipo: "",
        name: "",
        
        nodoid: "",
        position: "",
        coordinator: "",
        firmwaretype: "",
        placatype: "",
        frequency: "",
        
        chipcompany: "",
        sondatype: "",
        sondalarge: "",
        maxhigh: "",
        sensorhigh: "",
        waterhigh: "",
        deeppool: "",
        staticlevel: "",
        dinamiclevel: "",
        referencesensor: "",
        pulses: "",
        energytype: "",
          
        
        Coments: ""
      }
     


      
    };
  },
 
  created() {
    this.getInstalaciones();
    this.getEquipos();
  },
  
  
  
  
  methods: {
    
    ////////////////////// Get Instalaciones //////////////////////
    getInstalaciones() {
      console.log("buscar instalaciones");
      axios.get("http://localhost:80/support/all").then((res) => {
        console.log("instalaciones", res.data);
        this.instalaciones = res.data;
      });
    },

    //////////////////// Get by status //////////////////////////////
    get_byStatus(status) {
      this.statusDialog = false;
      console.log("buscar instalaciones");
      axios.get("http://localhost:80/support/status/"+status).then((res) => {
        console.log("instalaciones", res.data);
        this.instalaciones = res.data;
      });
    }, 
    
    getFiltre(statusInput){
     if (statusInput == "All") this.getInstalaciones();
     else this.get_byStatus(statusInput);
     this.statusDialog = false;

    },

    //////////// Get equipos ///////////////////////////////////
    getEquipos() {
      console.log("Obteniendo Equipos");
      axios
        .get("http://localhost:80/instalation/equipos/all")
        .then((res) => {
          for(var i = 0; i < res.data.length ; i++ ){
            this.equipos.push(res.data[i].equipement);
            this.atributesEquipos.push(res.data[i].atributes.split(','));
          } 
        
        console.log("Equipos",this.equipos); 
        console.log("Atributes",this.atributesEquipos); 
      
        })
    },
    
     ///////////////// Detalles ///////////////////////
    showDetails(item){
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem= Object.assign({}, item);
      this.detailsDialog = true;        
    },

    closeDetails() {
        this.detailsDialog = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
    },

    ///////////// Validar ///////////////////////

    validateItem(item){
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem= Object.assign({}, item);
      this.validateDialog = true; 
    },

    validate(){
      this.validateDialog = false;
      this.editedItem.status = "Ready";
      console.log("Validar para proxima entrega");
      
      axios
        .put("http://localhost:80/support/"+ this.editedItem.id, this.editedItem)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err); 
        });        
      
    
    },
    
    closeValidate() {
        this.validateDialog = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
    },

  ////////////// Comentar ////////////////////////////

  editComent(item){
    this.editedIndex = this.instalaciones.indexOf(item);
    this.editedItem= Object.assign({}, item);
    this.comentDialog = true;
  },

  closeComent(){
    this.comentDialog = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
    },

 
 putComent(){
      
      this.comentDialog = false;
      console.log("Coment para proxima entrega");
      
      console.log("aaaa", this.editedItem);
    
      axios
        .put("http://localhost:80/support/"+ this.editedItem.id, this.editedItem)
        .then((res) => {
          console.log("resultado de post", res);
          this.getInstalaciones();
        })
        .catch((err) => {
          console.log(err); 
        });        
      
  },

    ////////////// Historial ////////////////////////////
    
   showHistory(item){
    this.editedIndex = this.instalaciones.indexOf(item);
    this.editedItem= Object.assign({}, item);
    
    console.log("Historial para proxima entrega");

      axios.get("http://localhost:80/support/history/"+ this.editedItem.id).then((res) => {
        console.log("historial", res.data);
        this.historial = res.data; 
      });

      this.historyDialog = true;
    
  },

  closeHistory(){
    this.historyDialog = false;
    this.historial = [],
    this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });

  }

    ///////////////////// Validate /////////////////////////

  
  },
};
</script>
