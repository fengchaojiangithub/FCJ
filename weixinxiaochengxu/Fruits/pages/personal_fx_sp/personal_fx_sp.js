var app = getApp()
page({
 data: {
     carts: [
      {cid:1008,title:'Zippo打火机',image:'../../images/img7.png',
      num:'1',price:'198.0',sum:'198.0'},
      {cid:1012,title:'iPhone7 Plus',image:'../../images/img7.png',
      num:'1',price:'7188.0',sum:'7188.0'},
      {cid:1031,title:'得力订书机',image:'../../images/img7.png',
      num:'3',price:'15.0',sum:'45.0'
       }]
 },
  
    
  selected:function(e){
        this.setData({
           selected1:false,
            selected:true
        })
    },
    selected1:function(e){
        this.setData({
            selected:false,
            selected21:true
        })
    },
     selected1:function(e){
        this.setData({
            selected:false,
            selected31:true
        })
    },
    
})

