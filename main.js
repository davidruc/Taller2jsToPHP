let myForm = document.querySelector("#myForm");
myForm.addEventListener("submit", async(e)=>{
    e.preventDefault();
    let myHeaders = new Headers({"content-Type": "application/json"});
    let data = Object.fromEntries(new FormData(e.target));
    let config = {
        method: "POST",
        headers: myHeaders,
        body: JSON.stringify(data)
        };
    let res = await (await fetch("api.php", config)).text();
    console.log(res);
    document.querySelector("pre").innerHTML = res;
    console.log(res);
})