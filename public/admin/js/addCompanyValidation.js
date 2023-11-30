document.addEventListener('DOMContentLoaded', ()=>{
    let companyName       = document.getElementById('companyName');
    let companyEmail      = document.getElementById('companyEmail');
    let companyLogo       = document.getElementById('companyLogo'); 
    let addCompanyForm    = document.getElementById('addCompanyForm');
    let errorCompanyName  = document.getElementById('errorCompanyName'); 
    let errorCompanyEmail = document.getElementById('errorCompanyEmail'); 
    let errorCompanyLogo  = document.getElementById('errorCompanyLogo');  
    let successToastMsg  = document.getElementById('successToastMsg');  
    addCompanyForm.addEventListener('submit', e => {
        e.preventDefault();
        let res = isValid(); 
        (res == true) ? formSubmit()  : '' ;
    });
    function isValid()
    {
        let flag = true;
        let companyNameValue  = companyName.value.trim();
        let companyEmailValue = companyEmail.value.trim();
        let companyLogoValue  = companyLogo.value.trim();
        let matchFound = false;
        var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let emailPatternCheck = regEmail.test(companyEmailValue);
        if(companyLogoValue != "")
        {
            let filename            = companyLogo.files[0].name;
            let fileExtension       = filename.split('.').pop();
            let supportedExtensions = ['jpg','jpeg','gif','png','bmp'];
            let i = 0;
            for(i = 0; i<supportedExtensions.length; i++ )
            {
                if(fileExtension == supportedExtensions[i])
                {
                    matchFound = true; 
                    break;
                }
            }
        }  
        if(companyNameValue == '')
        {
            errorCompanyName.innerHTML = "* Company name required";
            setTimeout(function(){
                errorCompanyName.innerHTML="";
            },3000);
            flag = false;
        }  
        else if ((companyEmailValue != "") && (emailPatternCheck == false)) 
        {
            errorCompanyEmail.innerHTML = "* Email not valid";
            setTimeout(function(){
                companyEmailValue.innerHTML="";
            },3000);
            flag = false;
        }
        else if((companyLogoValue != "") && (matchFound == false))
        {
            errorCompanyLogo.innerHTML = "* Company logo must be greater than 100*100";
            setTimeout(function(){
                errorCompanyLogo.innerHTML="";
            },3000);
            flag = false;
        }
        return flag;
    }
    function formSubmit()
    {
        let formData = new FormData();
        let companyNameValue  = companyName.value.trim();
        let companyEmailValue = companyEmail.value.trim();
        let companyLogoValue  = companyLogo.value.trim();
        formData.append('companyNameValue',companyNameValue);
        formData.append('companyEmailValue',companyEmailValue);
        formData.append('companyLogoValue', document.querySelector('#companyLogo').files[0]);
        let url =  addCompanyForm.action ;
        let token = document.querySelector('meta[name="csrf-token"]').content; 
        fetch(url, {
            method: 'post',
            body: formData,
            headers: {
              "X-CSRF-TOKEN": token,
              "Accept": 'application/json',
            },
          }).then(function (response) {
            return response.json();
           
          }).then(function (json) {  
             let status = json.status;
              switch(status)
              {
                  case 200 :
                        //  $('#successToastMsg').toast('show');
                    break;
                  case 400 :
                   
                    break;
                   default:
                    break;  
              }
          })
            .catch(function (error) {
        });
   }
});