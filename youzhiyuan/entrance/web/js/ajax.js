function jqueryAdd(url,data){
 				 $.ajax({
                        url:url,
                        type:'get',
                        dataType:'jsonp',
                        data:data,
                        jsonp:'callback',
                        success:function(msg) {
                            console.log(msg);
                        }

                    });
}