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
        dimensoes: [],
        perguntas: [],
        matriz: []  
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
                                } else{
                                    fetch('controller/main.php?perguntaAtualizada').then(a=>a.json()).then(res=>{
                                        vue.perguntas = res
                                    })
                                }                                     
                                vue.sub_pag = 1
                                vue.idx=-1
                            })
                        }else{
                            Swal.fire( { 
                                title:'Erro!',  
                                text:'Erro interno!!',  
                                icon:'error',
                                confirmButtonColor: '#0d6efd',
                            })
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
                                erro = "Essa dimensão está associada a pergunta "+a.id+", por favor remova essa dimensão da pergunta antes de deletá-la!!"                                                                          
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
    vue.filterByPg = null
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
    vue.filterByDm = "Filtar por dimensões"
    vue.perguntas = vue.matriz.filter(a=>{
        if(a.pergunta.includes(valor)){
           return [a]
        }
    })
}       