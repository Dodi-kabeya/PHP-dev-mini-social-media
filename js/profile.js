

function triggerclick(){
    document.querySelector("#profileImage").click();
}

function displayImage(e){
    if(e.files[0]){
        var reader = new FileReader();

        reader.onload = (e)=>{
            document.querySelector("#profileDisplay").setAttribute('src', e.target.result);
            image.setAttribute('src', e.target.result);
        }

        reader.readAsDataURL(e.files[0]);
    }
}

// profile pic end
