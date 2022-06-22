<template>
    
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <!-- Inicio do card de busca -->
               <card-component titulo="Busca de Inscritos">
                    
                    <template v-slot:conteudo>
                        <div class="form-row">
                                <div class="mb-3 col">
                                    <input-container-component titulo="Estado Do Inscrito" id="inputEstado" id-help="estadoHelp" texto-ajuda="Opcional. Informe o Estado do Inscrito.">                      
                                        <input type="text" class="form-control" id="inputEstado" aria-describedby="estadoHelp" placeholder="Estado">
                                    </input-container-component>      
                                </div>   

                                <div class="mb-3 col">  
                                    <input-container-component titulo="Nome do Inscrito" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional. Informe o nome do Inscrito.">                      
                                        <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Inscrito">
                                    </input-container-component>  
            
                                </div>
                            </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                    </template>

               </card-component>
               
                <!-- Fim do card de busca-->

                <!-- Inicio do card de Listagem-->
                <card-component titulo="Relaçao de Inscritos">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>

                    <template v-slot:rodape>
                        <button type="button" data-toggle="modal" data-target="#modalInscrito" class="btn btn-primary btn-sm float-right">Adicionar</button>
                    </template>
                </card-component>


                <!-- Fim do card de Listagem-->
            </div>
        </div>

        <!-- MODAL -->
        <!-- Button trigger modal -->
        
        <modal-component id="modalInscrito" titulo="Adicionar Inscrito">
            
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome" id="novoNome" id-help="novoNomeHelp" texto-ajuda="">                      
                        <input type="text" v-model="nomeInscrito" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome Completo">
                    </input-container-component>
                    {{nomeInscrito}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Cpf" id="novoCpf" id-help="novoCpfHelp" texto-ajuda="">                      
                        <input type="digit" v-model="cpf" v-mask="'###.###.###-##'" class="form-control" id="novoCpf" aria-describedby="novoCpfHelp" placeholder="Insira um CPF válido">
                    </input-container-component>
                    {{cpf}}
                </div>

                <div class="form-group">
                    <input-container-component :value="uf" titulo="Email" id="novoEmail" id-help="novoEmailHelp" texto-ajuda="">                      
                        <input type="email" v-model="email" class="form-control" id="novoEmail" aria-describedby="novoEmailHelp" placeholder="exemplo@email.com">
                    </input-container-component>
                    {{email}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Cep" id="novoCep" id-help="novoCepHelp" texto-ajuda="">                      
                        <input type="digit" @blur="getCep()" v-model="ncep"  v-mask="'#####-###'" class="form-control" id="novoCep" aria-describedby="novoCepHelp" placeholder="Informe o Cep">
                    </input-container-component>
                    {{ncep}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Estado" id="novoEstado" id-help="novoEstadoHelp" texto-ajuda="">                      
                        <input type="text" :value="uf"  v-mask="'AA'" class="form-control" id="novoEstado" aria-describedby="novoEstadoHelp" placeholder="Estado">
                    </input-container-component>
                    {{uf}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Cidade" id="novoCidade" id-help="novoCidadeHelp" texto-ajuda="">                      
                        <input type="text"  :value="cidade" class="form-control" id="novoCidade" aria-describedby="novoCidadeHelp" placeholder="Cidade">
                    </input-container-component>
                    {{cidade}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Bairro" id="novoBairro" id-help="novoBairroHelp" texto-ajuda="">                      
                        <input type="text"  :value="bairro" class="form-control" id="novoBairro" aria-describedby="novoBairroHelp" placeholder="Bairro">
                    </input-container-component>
                    {{bairro}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Logradouro" id="novoLogradouro" id-help="novoLogradouroHelp" texto-ajuda="">                      
                        <input type="text" :value="logradouro" class="form-control" id="novoLogradouro" aria-describedby="novoLogradouroHelp" placeholder="Nome da rua">
                    </input-container-component>
                    {{logradouro}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Numero" id="novoNumero" id-help="novoNumeroHelp" texto-ajuda="">                      
                        <input type="number" v-model="numero" class="form-control" id="novoNumero" aria-describedby="novoNumeroHelp" placeholder="Número da casa/ap">
                    </input-container-component>
                    {{numero}}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Complemento" id="novoComplemento" id-help="novoComplementoHelp" texto-ajuda="">                      
                        <input type="text" v-model="complemento" class="form-control" id="novoComplemento" aria-describedby="novoComplementoHelp" placeholder="Complemento">
                    </input-container-component>
                    {{complemento}}
                </div>
                
            </template>
            
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" @click="salvar()" class="btn btn-primary">Salvar</button>
            </template>
            
        </modal-component>
        
        
</div>
</template>

<script>
    import {TheMask} from 'vue-the-mask'

    export default {
        components: {TheMask},
        data(){
            return{
                ncep:"",
                uf:"",
                cidade:"",
                bairro:"",
                logradouro:"",
                nomeInscrito:"",
                cpf:"",
                email:"",
                numero:0,
                complemento:"",
                urlBase:'http://localhost:8000/api/v1/inscrito'

            }
        },
        methods:{
            getCep(ev){
                let cep = this.ncep.replace(/-/g, '');
                
                let url = "https://viacep.com.br/ws/"+cep+"/json/"
                
                fetch(url)
                .then((response)=>{
                    response.json().then((data)=>{
                        this.uf = data.uf
                        this.cidade = data.localidade
                        this.bairro = data.bairro
                        this.logradouro = data.logradouro
                    })
                })      
            },
            salvar(){

                let formData = new FormData();
                formData.append('nome',this.nomeInscrito)
                formData.append('cpf',this.cpf)
                formData.append('estado',this.uf)
                formData.append('cidade',this.cidade)
                formData.append('bairro',this.bairro)
                formData.append('logradouro',this.logradouro)
                formData.append('numero',this.numero)
                formData.append('complemento',this.complemento)
                formData.append('cep',this.ncep)

                let config = {
                    headers:{
                        'Content-Type': 'multipart/form-data',
                        'Accept':'application/json'
                    }
                }

                axios.post(this.urlBase, formData, config )
                .then(response => {
                    console.log(response)
                }).catch(errors =>{
                    console.log(errors)
                })
                
            }
        }
    }
</script>
