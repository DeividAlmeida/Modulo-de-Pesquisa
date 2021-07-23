<?php
error_reporting(0);
require_once('controller/main.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <title>Módulo de perguntas</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
        <style>
            .add{
                white-space: nowrap;
            }

            .dropdown-menu{
                right:10%;
            }
            
            .box {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            top: 5px;
            }

            .box input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
            }

            .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #bdbdbd;
            border-radius: 50%;
            }

            .box:hover input ~ .checkmark {
            background-color: #ccc;
            }

            .box input:checked ~ .checkmark {
            background-color: #00b24e;
            }

            .box .checkmark:after {
                content: "";
                position: absolute;
                display: none;
                left: 8px;
                top: 3px;
                width: 7px;
                height: 16px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate( 45deg);

            }

            .box input:checked ~ .checkmark:after {
            display: block;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid my-3" id="main">        
            <div class="card-header ">
                <h5 class="card-title justify-content-center d-flex text-uppercase">Módulo de perguntas</h5>   
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a :class="pag !=2?'nav-link active':'nav-link'" @click="a=>{pag=1;sub_pag=1}" href="#">Dimensões</a>
                    </li>
                    <li class="nav-item">
                        <a :class="pag ==2?'nav-link active':'nav-link'" @click="a=>{pag=2;sub_pag=1}" href="#">Perguntas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body" v-if="pag !=2">
                <div class="row justify-content-end" v-if="sub_pag ==1"> 
                    <div class="col-lg-2 col-md-3 col-sm-4 col-8">
                        <button type="button" class="btn btn-primary m-3 float-right add" @click="a=>{sub_pag=2; idx=-1}">
                            <i class="fas fa-plus"></i> Criar dimensão
                        </button>
                    </div>     
                </div>
                <table  id="DataTable" class="table m-0 table-striped" v-if="sub_pag ==1">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>                        
                        <th width="100px">Ações</th>
                    </tr>
                    <tr v-for="dimensao, id of dimensoes">
                        <td>{{dimensao.id}}</td>
                        <td>{{dimensao.dimensao}}</td>
                        <td>
                            <div class="btn-group" @click="dropdown(id)">
                                <button class="btn btn-primary" role="button" >
                                    <i :class="sub_menu !== id? 'fas fa-caret-square-down':'fas fa-caret-square-up'"></i>
                                </button>
                                <div :class="sub_menu === id? 'dropdown-menu show mt-5 ': 'dropdown-menu'" >
                                    <a class="dropdown-item" href="#" @click="b=>{idx=id;sub_pag=2}"> <i class="fas fa-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="#" @click="remove(dimensao.id,id)"><i class="fas fa-trash-alt"></i> Deletar</a>                                     
                                </div>
                            </div>
                        </td>                        
                    </tr>
                    <tr v-if="perguntas.length<=0">
                        <td colspan="5" style="text-align: center">
                            Nenhuma dimensão encontrada
                        </td>
                    </tr>
                </table>
                <form action="POST" v-if="sub_pag == 2" id="formDimensao" >
                    <div class="row justify-content-md-center">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Nome da dimensão: </label>
                                <input v-if="idx >= 0" placeholder="Nome" class="form-control" v-model="dimensoes[idx].dimensao" name="dimensao" required>
                                <input v-else class="form-control"  name="dimensao" required>
                            </div>
                            <div class="row justify-content-start m-2">
                                <div class="col-12">
                                    <button  class="btn btn-primary m-2" type="submit" ><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
                                    <button  class="btn btn-danger m-2" type="button" @click="a=>{sub_pag=1; idx=-1}"><i class="icon icon-save" aria-hidden="true"></i> Cancelar</button>
                                </div>
                            </div>                    
                        </div>
                    </div>                    
                </form>
            </div>  
            <div class="card-body" v-if="pag ==2">
                <div class="row " v-if="sub_pag ==1"> 
                    <div class=" col-md-4 col-sm-4 col-8">                        
                        <select class='form-control  m-sm-3 m-1' :value="filterByDm" onchange="filterByDm(this.value)"> 
                            <option hidden>Filtar por dimensões</option>
                            <option value=false>Todas as dimensões</option>
                            <option v-for="dimensao, id of dimensoes" :value="dimensao.dimensao">{{dimensao.dimensao}}</option>  
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-8">
                        <div class="form-group m-sm-3 m-1">                  
                            <input class="form-control" placeholder="filtrar por pergunta" :value="filterByPg" oninput="filterByPg(this.value)">
                        </div>
                    </div>
                    <div class="offset-lg-2 col-lg-2 col-md-3 col-sm-4 col-8">
                        <button type="button" class="btn btn-primary m-sm-3 m-1 float-right add" @click="a=>{sub_pag=2; idx=-1}">
                            <i class="fas fa-plus"></i> Criar pergunta
                        </button>
                    </div>     
                </div>                
                <table  id="DataTable" class="table m-0 table-striped"  v-if="sub_pag ==1">
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Dimensão</th>                        
                        <th>Pergunta</th>                        
                        <th width="100px">Ações</th>
                    </tr>
                    <tr v-for="pergunta, id of perguntas">
                        <td>{{pergunta.id}}</td>
                        <td>
                        <label class="box"> 
                            <input type="checkbox" :checked="pergunta.status == 1? true:false" @change="status(pergunta.id,id,$event.target.checked)">
                            <span class="checkmark"></span>
                        </label>
                        </td>
                        <td>{{pergunta.dimensao}}</td>                        
                        <td>{{pergunta.pergunta}}</td>                        
                        <td>
                            <div class="btn-group" @click="dropdown(id)">
                                <button class="btn btn-primary" role="button" >
                                    <i :class="sub_menu !== id? 'fas fa-caret-square-down':'fas fa-caret-square-up'"></i>
                                </button>
                                <div :class="sub_menu === id? 'dropdown-menu show mt-5 ': 'dropdown-menu'" >
                                    <a class="dropdown-item" href="#" @click="b=>{idx=id;sub_pag=2}"> <i class="fas fa-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="#" @click="remove(pergunta.id,id)"><i class="fas fa-trash-alt"></i> Deletar</a>                                     
                                </div>
                            </div>
                        </td>                                         
                    </tr>
                    <tr v-if="perguntas.length<=0">
                        <td colspan="5" style="text-align: center">
                            Nenhuma pergunta encontrada
                        </td>
                    </tr>
                </table>
                <form action="POST" v-if="sub_pag == 2" id="formPergunta" >
                    <div class="row justify-content-md-start">
                        <div class="col-sm-5 m-2">
                            <div class="form-group">
                                <label>Dimensão: </label>
                                <select class='form-control'  v-if="idx >= 0" v-model="perguntas[idx].dimensao">                                    
                                    <option v-for="dimensao, id of dimensoes" :value="dimensao.dimensao">{{dimensao.dimensao}}</option>  
                                </select>
                                <select class='form-control'  v-else> 
                                    <option hidden selected>Selecione uma Dimensão</option>
                                    <option v-for="dimensao, id of dimensoes" :value="dimensao.dimensao">{{dimensao.dimensao}}</option>  
                                </select>
                            </div>    
                        </div>
                        <div class="col-sm-6 m-2">
                            <div class="form-group">
                                <label>Texto da pergunta: </label>
                                <input v-if="idx >= 0" placeholder="Nome" class="form-control" v-model="perguntas[idx].pergunta" name="dimensao" required>
                                <input v-else class="form-control"  name="dimensao" required>
                            </div>
                        </div>
                        <div class="row justify-content-start m-2">
                            <div class="col-12">
                                <button  class="btn btn-primary m-2" type="submit" ><i class="icon icon-save" aria-hidden="true"></i> Salvar</button>
                                <button  class="btn btn-danger m-2" type="button" @click="a=>{sub_pag=1; idx=-1}"><i class="icon icon-save" aria-hidden="true"></i> Cancelar</button>
                            </div>
                        </div>                   
                    </div>                    
                </form>
            </div>  
        </div>           
    </body>
    <script>  
        let form = new FormData()      
        const vue = new Vue({
            el:"#main",
            data: {
                filterByDm:"Filtar por dimensões",
                filterByPg:null,
                pag:1,
                sub_pag:1, 
                idx: -1,                
                sub_menu:false,
                dimensoes: <?php echo $dimensoes?>,
                perguntas: <?php echo $perguntas?>,
                matriz: <?php echo $perguntas?>  
            },
            updated: function(){
                this.$nextTick(function(){                   
                    if(!Array.isArray(this.dimensoes) && typeof(this.dimensoes) != "string" || this.dimensoes == 'null'){
                        this.dimensoes = []
                    }
                    if(!Array.isArray(this.perguntas) && typeof(this.perguntas) != "string" || this.perguntas == 'null'){
                        this.perguntas = []
                    }
                    if(this.sub_pag == 2){
                        document.querySelectorAll('form')[0].addEventListener('submit', function (event){                               
                            event.preventDefault()   
                            event.stopPropagation()                                
                            let route 
                            switch(vue.pag) {
                                case 1:
                                    form.append('dimensao', document.querySelectorAll('input')[0].value)
                                    vue.idx <0? 
                                        route = 'controller/main.php?dimensao': 
                                        route = 'controller/main.php?dimensaoEdita='+vue.dimensoes[vue.idx].id
                                break;
                                case 2:
                                    form.append('pergunta', document.querySelectorAll('input')[0].value)
                                    form.append('dimensao', document.querySelectorAll('select')[0].value)
                                    vue.idx <0? 
                                        route = 'controller/main.php?pergunta': 
                                        route = 'controller/main.php?perguntaEdita='+vue.perguntas[vue.idx].id
                                break;
                            }
                            
                            fetch(route,{
                                method: 'POST',
                                body: form
                            }).then(a=>a.text()).then(data=>{
                                if(data>0){
                                    setTimeout(function(){
                                        Swal.fire( { 
                                            title:'Salvo!',  
                                            text:'Item salvo com sucesso!',  
                                            icon:'success',
                                            confirmButtonColor: '#0d6efd',
                                        }).then(next => { 
                                            if(vue.pag == 1) {                                                
                                                fetch('controller/main.php?dimensaoAtualizada').then(a=>a.json()).then(res=>{
                                                    vue.dimensoes = res
                                                })
                                                fetch('controller/main.php?perguntaAtualizada').then(a=>a.json()).then(res=>{
                                                    vue.perguntas = res
                                                })
                                            } else if(vue.pag == 2 && vue.idx <0){
                                                vue.perguntas.push({pergunta:document.querySelectorAll('input')[0].value, id:data, dimensao:document.querySelectorAll('select')[0].value,status:'1'})
                                            }                                     
                                            vue.sub_pag = 1
                                            vue.idx=-1
                                        })
                                     }, 600);
                                }else{
                                    setTimeout(function(){
                                        Swal.fire( { 
                                            title:'Erro!',  
                                            text:'Erro interno!!',  
                                            icon:'error',
                                            confirmButtonColor: '#0d6efd',
                                        })
                                     }, 400);
                                }

                            })   
                            
                        })
                    }  
                                              
                })
            },
            methods:{
                dropdown: function(id){                  
                    if(this.sub_menu === id){                         
                        this.sub_menu = false 
                    }else{                        
                        this.sub_menu = id
                    }
                },
                status: function(id,idx,valor){
                    this.perguntas[idx].status=valor
                    valor?valor=1:valor=0
                    form.append('status',valor)
                    fetch('controller/main.php?status='+id,{
                        method: 'POST',
                        body: form
                    })
                },
                remove: function(id,idx){
                    let erro = 'Erro interno!!'
                    let route
                    let item                    
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: 'Você deseja realmente deletar esse item?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0d6efd',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, eu tenho certeza!',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            if(this.pag == 1){
                                item = 'this.dimensoes.splice(idx, 1)'
                                route = 'controller/main.php?Deletardimensao='+id
                                vue.perguntas.filter(a=>{
                                    if(a.dimensao === vue.dimensoes[idx].dimensao){
                                        route = 0  
                                        erro = "Essa dimensão está associada a pergunta "+a.id+", por favor remova essa dimensão da pergunta ante de deletá-la!!"                                                                          
                                    }                                    
                                })
                            }else{
                                route = 'controller/main.php?Deletarpergunta='+id
                                item = 'this.perguntas.splice(idx, 1)'
                            }
                            fetch(route).then(a=>a.text()).then(res=>{
                                if(res>0){
                                   eval(item)
                                    Swal.fire( { 
                                        title:'Deletado!',  
                                        text:'Item deletado com sucesso!',  
                                        icon:'success',
                                        confirmButtonColor: '#0d6efd',
                                    })
                                }else{
                                    Swal.fire( { 
                                        title:'Erro!',  
                                        text:erro,  
                                        icon:'error',
                                        confirmButtonColor: '#0d6efd',
                                    })
                                }
                            })
                        }else{
                            Swal.fire( { 
                                title:'Cancelado!',  
                                text:'Operação cancelada!',  
                                icon:'error',
                                confirmButtonColor: '#0d6efd',
                            })
                        }
                    })
                }
            }
        })
        function filterByDm(valor){
            vue.filterByDm = valor
            vue.perguntas = vue.matriz.filter(a=>{
                if(a.dimensao === valor){
                   return [a]
                } else if (valor == "false"){
                    return vue.matriz
                }
            })
        } 
        function filterByPg(valor){  
            vue.filterByPg = valor          
            vue.perguntas = vue.matriz.filter(a=>{
                if(a.pergunta.includes(valor)){
                   return [a]
                }
            })
        }       
    </script>
</html>