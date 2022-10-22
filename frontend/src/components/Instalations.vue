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
                <v-toolbar-title>Mis instalaciones</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                    <v-btn
                      color="primary"
                      dark
                      class="mb-2"
                      @click="newInstalationDialog=true"
                    >
                      Nueva instalacion
                    </v-btn> 
              </v-toolbar>
            </template>
            
            
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
              <v-icon small class="mr-2" @click="showHistory(item)" >  mdi-clipboard-text-clock </v-icon>
              <v-icon small class="mr-2" @click="showDetails(item)">  mdi-dots-grid </v-icon>
              <v-icon v-if="item.Coments!=null" small class="mr-2" @click="showComents(item)"> mdi-comment-alert</v-icon>
              
            </template>
          
          </v-data-table>
        </v-col>
      </v-row>

     <br />
    </div>
      
      
      <!---------------------------------------------------------------------------------->
      <!----------------------------- NUEVA INSTALACION DIALOGO --------------------------->
      <!---------------------------------------------------------------------------------->
      
      <v-dialog v-model="newInstalationDialog" width="500">        
        <v-card>
          <v-card-title class="text-h5 blue" >
          Nueva Instalacion
          </v-card-title>

          <v-divider class="mx-4" inset vertical></v-divider>
          
          <v-card-text>
            <v-form>
              <v-row>
               
                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.tecnicoid"
                    :counter="10"
                    label="ID Tecnico"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
               
               
                <v-col class="my-2" cols="12">
                  <v-text-field
                    v-model="newInstalacion.clientid"
                    :counter="10"
                    label="ID Client"
                    required
                  ></v-text-field>
                </v-col>
                
                
                <v-col cols="12" class="my-n2">
                  <h3 class="mb-2">Fecha</h3>
                  <v-date-picker v-model="newInstalacion.date"></v-date-picker>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.status"
                    :counter="10"
                    label="Status"
                    readonly
                    outlined
                  ></v-text-field>
                </v-col>
                
                
                
                 <v-col cols="12">
                  <v-select
                    v-model="newInstalacion.equipo"
                    :items="equipos"
                    label="Equipo"
                  ></v-select>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.name"
                    :counter="10"
                    label="Nombre equipo"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.nodoid"
                    :counter="10"
                    label="Nodo ID"
                    required
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.position"
                    :counter="10"
                    label="Posicion"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.coordinator"
                    :counter="10"
                    label="Coordinador"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.firmwaretype"
                    :counter="10"
                    label="Tipo de Firmware"
                    required
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.placatype"
                    :counter="10"
                    label="Tipo de Placa"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="newInstalacion.frequency"
                    :counter="10"
                    label="Frecuencia de envio"
                    required
                  ></v-text-field>
                </v-col>
                
    
                  <div class="m2" v-for="(equipo, index) in equipos" :key="index">
                    <div v-if="newInstalacion.equipo == equipo">
                        
                      <v-col cols="12" v-if="atributesEquipos[index].includes('chipcompany')">
                        <v-text-field 
                            v-model="newInstalacion.chipcompany"
                            :counter="20"
                            label="Compañia de chip"
                            required
                            ></v-text-field>
                      </v-col>

                       <v-col cols="12" v-if="atributesEquipos[index].includes('sondatype')">
                        <v-text-field 
                            v-model="newInstalacion.sondatype"
                            :counter="20"
                            label="Tipo de sonda"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sondalarge')">
                        <v-text-field 
                            v-model="newInstalacion.sondalarge"
                            :counter="20"
                            label="Largo de sonda"
                            required
                            ></v-text-field>
                      </v-col>
                      
                      <v-col cols="12" v-if="atributesEquipos[index].includes('maxhigh')">
                        <v-text-field 
                            v-model="newInstalacion.maxhigh"
                            :counter="20"
                            label="Altura maxima"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sensorhigh')">
                        <v-text-field 
                            v-model="newInstalacion.sensorhigh"
                            :counter="20"
                            label="Altura de sensor"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('waterhigh')">
                        <v-text-field 
                            v-model="newInstalacion.waterhigh"
                            :counter="20"
                            label="Altura de agua"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('deeppool')">
                        <v-text-field 
                            v-model="newInstalacion.deeppool"
                            :counter="20"
                            label="Profunidad de pozo"
                            required
                            ></v-text-field>
                      </v-col>


                      <v-col cols="12" v-if="atributesEquipos[index].includes('staticlevel')">
                        <v-text-field 
                             v-model="newInstalacion.staticlevel"
                            :counter="20"
                            label="Nivel Estatico"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('dinamiclevel')">
                        <v-text-field 
                            v-model="newInstalacion.dinaminclevel"
                            :counter="20"
                            label="Nivel dinamico"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('referencesensor')">
                        <v-text-field 
                             v-model="newInstalacion.referencesensor"
                             label="Sensor de Referencia"
                            :counter="20"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('pulses')">
                        <v-text-field 
                            v-model="newInstalacion.pulses"
                            :counter="20"
                            label="Pulsos"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('energytype')">
                        <v-text-field 
                            v-model="newInstalacion.energytype"
                            :counter="20"
                            label="Tipo de energia"
                            required
                            ></v-text-field>
                      </v-col>
                    </div>
                  </div>
                 
              </v-row>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="addInstalacion">
              Añadir Instalación
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>


      <!---------------------------------------------------------------------------------->
      <!----------------------------- TECNICO DIALOGO -------------------------------------->
      <!---------------------------------------------------------------------------------->
        
        
      <v-dialog persistent v-model="tecnicoDialog" width="500px">        
        <v-card>
          <v-card-title class="text-h5 blue">
          Ingrese ID Tecnico
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col class="my-2" cols="12">
                  <v-text-field
                    v-model="newInstalacion.tecnicoid"
                    :counter="10"
                    label="ID Tecnico"
                    required
                  ></v-text-field>
                 </v-col>

              </v-row>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="getByTecnicoID(newInstalacion.tecnicoid)">
              OK
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
   
   
    <!---------------------------------------------------------------------------------->
    <!----------------------------- EDITAR DIALOGO -------------------------------------->
    <!---------------------------------------------------------------------------------->

    <v-dialog persistent v-model="editDialog" max-width="500px">
      <v-card>
        <v-card-title  class="text-h5 blue">
          <span class="text-h5"> Editar</span>
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
                    required
                  ></v-text-field>
                </v-col>
                
                
                <v-col cols="12" class="my-n2">
                  <h3 class="mb-2">Fecha</h3>
                  <v-date-picker v-model="editedItem.date"></v-date-picker>
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
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.nodoid"
                    :counter="10"
                    label="Nodo ID"
                    required
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.position"
                    :counter="10"
                    label="Posicion"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.coordinator"
                    :counter="10"
                    label="Coordinador"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.firmwaretype"
                    :counter="10"
                    label="Tipo de Firmware"
                    required
                  ></v-text-field>
                </v-col>
                
                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.placatype"
                    :counter="10"
                    label="Tipo de Placa"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="editedItem.frequency"
                    :counter="10"
                    label="Frecuencia de envio"
                    required
                  ></v-text-field>
                </v-col>
                
                <div class="m2" v-for="(equipo, index) in equipos" :key="index">
                    <div v-if="editedItem.equipo == equipo">
                        
                      <v-col cols="12" v-if="atributesEquipos[index].includes('chipcompany')">
                        <v-text-field 
                            v-model="editedItem.chipcompany"
                            :counter="20"
                            label="Compañia de chip"
                            required
                            ></v-text-field>
                      </v-col>

                       <v-col cols="12" v-if="atributesEquipos[index].includes('sondatype')">
                        <v-text-field 
                            v-model="editedItem.sondatype"
                            :counter="20"
                            label="Tipo de sonda"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sondalarge')">
                        <v-text-field 
                            v-model="editedItem.sondalarge"
                            :counter="20"
                            label="Largo de sonda"
                            required
                            ></v-text-field>
                      </v-col>
                      
                      <v-col cols="12" v-if="atributesEquipos[index].includes('maxhigh')">
                        <v-text-field 
                            v-model="editedItem.maxhigh"
                            :counter="20"
                            label="Altura maxima"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('sensorhigh')">
                        <v-text-field 
                            v-model="editedItem.sensorhigh"
                            :counter="20"
                            label="Altura de sensor"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('waterhigh')">
                        <v-text-field 
                            v-model="editedItem.waterhigh"
                            :counter="20"
                            label="Altura de agua"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('deeppool')">
                        <v-text-field 
                            v-model="editedItem.deeppool"
                            :counter="20"
                            label="Profunidad de pozo"
                            required
                            ></v-text-field>
                      </v-col>


                      <v-col cols="12" v-if="atributesEquipos[index].includes('staticlevel')">
                        <v-text-field 
                             v-model="editedItem.staticlevel"
                            :counter="20"
                            label="Nivel Estatico"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('dinamiclevel')">
                        <v-text-field 
                            v-model="editedItem.dinaminclevel"
                            :counter="20"
                            label="Nivel dinamico"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('referencesensor')">
                        <v-text-field 
                             v-model="editedItem.referencesensor"
                             label="Sensor de Referencia"
                            :counter="20"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('pulses')">
                        <v-text-field 
                            v-model="editedItem.pulses"
                            :counter="20"
                            label="Pulsos"
                            required
                            ></v-text-field>
                      </v-col>

                      <v-col cols="12" v-if="atributesEquipos[index].includes('energytype')">
                        <v-text-field 
                            v-model="editedItem.energytype"
                            :counter="20"
                            label="Tipo de energia"
                            required
                            ></v-text-field>
                      </v-col>
                    </div>
                  </div>
    
                  
                  
          
                  
                
                 
              </v-row>
            </v-form>
          </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="close">
            Cancel
          </v-btn>
          <v-btn color="blue darken-1" text @click="editarInstalacion">
            Editar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>



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
  
  
  <!---------------------------------------------------------------------------------->
  <!--------------------------------- HISTORIAL DIALOGO-------------------------------> 
  <!---------------------------------------------------------------------------------->


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
                      @click="closeHistory"
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

<!---------------------------------------------------------------------------------->
  <!--------------------------------- Coment DIALOGO-------------------------------> 
  <!---------------------------------------------------------------------------------->
  
  <v-dialog persistent v-model="comentDialog " max-width="500px">
      <v-card>
        <v-card-title class="text-h5 blue" 
          >Comentarios</v-card-title
        >
          <v-form>
            <v-textarea
              v-model="editedItem.Coments"
              color="teal"
              style="padding: 20px;"
              readonly
            >
              <template v-slot:label>
                  
              
              </template>
            </v-textarea>   


          </v-form>

     <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="comentDialog=false"
            >Salir</v-btn
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
      
      equipos: [],
      atributesEquipos: [],
      
      newInstalationDialog: false,
      tecnicoDialog: true,
      editDialog:false,
      historyDialog: false,
      detailsDialog: false,
      comentDialog: false,
     
      editedIndex: -1,
      
  
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
      
       
       
       /////////////////////////////// New Instalations Objet ////////////////////////////////////////////////
       
       newInstalacion: {
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
      },

      
      historyItem: {
        
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
      this.getEquipos();
      
  },
  
  ////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////Metodos ///////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////7
  
  methods: {
  
    getByTecnicoID(IDtecnico) {
      console.log("Instalaciones por ID tecnico");
      this.tecnicoDialog = false;
      axios.get("http://localhost:80/instalation/tecnicoid/"+ IDtecnico).then((res) => {
        console.log("Instalaciones por ID", res.data);
        this.instalaciones = res.data;
      });
    },
  
    
  
    /////////////////////////////// Obtener Equipos ///////////////////////////
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
        console.log("Atributos",this.atributesEquipos); 
      
        })
    }, 


    /////////////////////////// Nueva Instalacion /////////////////////////////////
    addInstalacion() {
      console.log("Nueva Instalacion");
      this.newInstalationDialog = false;
      let formData = {
        tecnicoid: parseInt(this.newInstalacion.tecnicoid),
        clientid: parseInt(this.newInstalacion.clientid),
        date: this.newInstalacion.date,
        status: this.newInstalacion.status,
        equipo: this.newInstalacion.equipo,
        name: this.newInstalacion.name,
        
        nodoid: this.newInstalacion.nodoid,
        position: this.newInstalacion.position,
        coordinator: this.newInstalacion.coordinator,
        firmwaretype: this.newInstalacion.firmwaretype,
        placatype: this.newInstalacion.placatype,
        frequency: this.newInstalacion.frequency,

        chipcompany: this.newInstalacion.chipcompany,
        sondatype: this.newInstalacion.sondatype,
        sondalarge: this.newInstalacion.sondalarge,
        maxhigh: this.newInstalacion.maxhigh,
        sensorhigh: this.newInstalacion.sensorhigh,
        waterhigh: this.newInstalacion.waterhigh,
        deeppool: this.newInstalacion.deeppool,
        staticlevel: this.newInstalacion.staticlevel,
        dinamiclevel: this.newInstalacion.dinamiclevel,
        referencesensor: this.newInstalacion.referencesensor,
        pulses: this.newInstalacion.pulses,
        energytype: this.newInstalacion.energytype,

        Coments: this.newInstalacion.Coments

        
      };
      
      axios
        .post("http://localhost:80/instalation/add", formData)
        .then((res) => {
          console.log("Resultado de Nueva instalacion", res.data);
          this.getByTecnicoID(formData.tecnicoid);
        })
        .catch((err) => {
          console.log(err);
        });
       
        this.newInstalacion = Object.assign({}, this.defaultItem);
    },


    
  
    /////////////////////////// Editar -Historial ///////////////////////////////
    editItem(item) {
      
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem= Object.assign({}, item);
      this.historyItem= Object.assign({}, item);
      this.editDialog = true;
    },

    editarInstalacion(){
      this.editDialog=false;

      console.log("Editar para proxima entrega");


      axios
        .post("http://localhost:80/support/add", this.historyItem)
        .then((res) => {
          console.log("resultado de post", res);
         
        })
        .catch((err) => {
          console.log(err); 
        });  
      
  
        
        axios
        .put("http://localhost:80/support/"+ this.editedItem.id, this.editedItem)
        .then((res) => {
          console.log("resultado de post", res);
          this.getByTecnicoID(this.editedItem.tecnicoid);
          this.editedItem = Object.assign({}, this.defaultItem);
          this.historyItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        })
        .catch((err) => {
          console.log(err); 
        });

       
      
    },
 
    close() {
        this.editDialog = false;
        this.$nextTick(() => {
          this.historyItem = Object.assign({}, this.defaultItem);
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
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

    ///////////////Coments //////////////////////////////////

    showComents(item){
      this.editedIndex = this.instalaciones.indexOf(item);
      this.editedItem= Object.assign({}, item);
      this.comentDialog = true;        
    },

    closeComent() {
        this.comentDialog = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        });
    },

  //////////////////////Historial///////////////////////////////////////

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
  
  
  }
}

</script>
