export const imgpre=(e)=>{
    var input=e.target.files[0];
    var reader=FileReader();
    reader.onload=function(){
        var result=reader.result;
        var img=document.getElementById('img');
        img.src=result;
    }
    reader.readAsURL(input)

}