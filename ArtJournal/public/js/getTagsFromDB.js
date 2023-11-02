let tagNameInput = document.getElementById("tags_input");
let datalist = document.getElementById("data_tags");

tagNameInput.addEventListener('keyup', function () {
    while (datalist.lastChild) {
        datalist.removeChild(datalist.lastChild);
    }

    console.log(tagNameInput.value);
    fetch("/tags/get"  ,
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
                'url': '/tags/get',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify({
                "tag": tagNameInput.value
            })
        }).then(res => res.json()).then(data => {


        for (let i = 0; i < data.tagNames.length; i++) {
            console.log("data: " + data.tagNames[i].tag_name);
            let option = document.createElement("option");
            // option.setAttribute("hidden", data[i].client_id);
            // option.setAttribute("value", data[i].name);
            option.innerText = data.tagNames[i].tag_name;
            datalist.appendChild(option);
        }
    });
})
