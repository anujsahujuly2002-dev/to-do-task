"use strict"

const makeWithPostRequest = async (url,formId)=>{
    try {
        showloader()
        const response = await fetch (url,{
            method:"POST",
            body:new FormData(formId)
        });
        if(!checkStatusCode(response)){
            showErrorMessage(response,formId)
        }
        if(checkStatusCode(response)){
            const res = await response.json();
            $(formId)[0].reset();
            toastr.success(res.message);
            setTimeout(function(){
                hideLoader();
                window.location.href=res.url;
            },2000);
        }
        
    } catch (error) {
        toastr.error(error.message);
    }
    
}

const checkStatusCode =  (response)=>{
    let status=false;
    hideLoader();
    if(response.status==200){
        status = true;
    }
    return status;
}


const showErrorMessage =  async(response,formId)=>{
    hideLoader();
    try{
        $(formId).find("p").text(" ");
        $(formId).find("div").removeClass("has-error");
        if(response.status==422){
            let errors = await response.json();
            for(let index in errors.error){
                $("."+index).addClass("has-error");
                $("."+index+"-error").text(errors.error[index]);
            }
        }
        if(response.status !=422){

            const res = await response.json();
            if(!res.status){
                log(res.message);
                showError(res.message.capitalize())
            }else if(response.status !=200){
                toastr.error(response.statusText.capitalize())
            }else if(response.status ==500){
                toastr.error(response.statusText.capitalize())
            }
        }
    }catch(error){
        toastr.error(error.message);
    }
    
}


const log =(response)=>{
    return console.log(response);
}


Object.defineProperty(String.prototype, 'capitalize', {
    value: function() {
      return this.charAt(0).toUpperCase() + this.slice(1);
    },
    enumerable: false
});


const makeWithPostCustomFormRequest = async (url,data,formId)=>{
    try {
        showloader()
        const response = await fetch (url,{
            method:"POST",
            body:data
        });
        if(!checkStatusCode(response)){
            showErrorMessage(response,formId)
        }
        if(checkStatusCode(response)){
            const res = await response.json();
           /*  $(formId)[0].reset(); */
            toastr.success(res.message);
            setTimeout(function(){
                hideLoader();
                window.location.href=res.url;
            },2000);
        }
        
    } catch (error) {
        toastr.error(error.message);
    }
    
}
