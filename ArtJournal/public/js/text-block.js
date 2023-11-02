let beginCoordinates = [0, 0];
let endCoordinates = [0, 0];
let form = document.getElementById("text-editor");
let input = document.getElementById('input');
let submitBtn, widthInput, heightInput, posXInput, posYInput;
let inputSize = {
    width: 0,
    height: 0
}
let resizeDiv;


document.addEventListener('mousedown', function (e) {
    beginCoordinates = [e.clientX, e.clientY];
})

document.addEventListener('mouseup', function (e) {
    endCoordinates = [e.clientX, e.clientY];
    if (input === null) {
        createInput();
    }
})

function createInput() {
    input = document.createElement('input');
    input.style.left = beginCoordinates[0] + 'px';
    input.style.top = beginCoordinates[1] + 'px';
    inputSize.width = endCoordinates[0] - beginCoordinates[0];
    inputSize.height = endCoordinates[1] - beginCoordinates[1];
    input.style.width = inputSize.width + 'px';
    input.style.height = inputSize.height + 'px';
    input.style.position = "absolute";

    input.id = "text";
    input.setAttribute("type", "text");
    input.setAttribute("name", "text_block_content");

    widthInput = document.createElement('input');
    widthInput.setAttribute("type", "hidden");
    widthInput.setAttribute("name", "width");
    widthInput.setAttribute("value", inputSize.width);

    heightInput = document.createElement('input');
    heightInput.setAttribute("type", "hidden");
    heightInput.setAttribute("name", "height");
    heightInput.setAttribute("value", inputSize.height);

    posXInput = document.createElement('input');
    posXInput.setAttribute("type", "hidden");
    posXInput.setAttribute("name", "pos_x");
    posXInput.setAttribute("value", beginCoordinates[0]);

    posYInput = document.createElement('input');
    posYInput.setAttribute("type", "hidden");
    posYInput.setAttribute("name", "pos_y");
    posYInput.setAttribute("value", beginCoordinates[1]);

    form.appendChild(input);
    form.appendChild(widthInput);
    form.appendChild(heightInput);
    form.appendChild(posXInput);
    form.appendChild(posYInput);

    submitBtn = document.createElement('button');
    submitBtn.setAttribute("value", "Submit");
    submitBtn.left = endCoordinates[0] + 10 + 'px';
    submitBtn.top = endCoordinates[1] + 10 + 'px';
    submitBtn.width = '5px';
    submitBtn.height = '5px';
    console.log(endCoordinates[0] + 10 + 'px');


    form.appendChild(submitBtn);


    // resizeDiv = document.createElement('div');
    // resizeDiv.style.left = endCoordinates[0] + 10 + 'px';
    // resizeDiv.style.top = endCoordinates[1] + 10 + 'px';
    // resizeDiv.style.width = '10px';
    // resizeDiv.style.height = '10px';
    // resizeDiv.style.border = 'solid gray 1px';
    // resizeDiv.style.position = "absolute";
    // form.appendChild(resizeDiv);

    input.addEventListener('mousedown', function (e) {
            input.isDown = true;
            input.offset = [
                input.offsetLeft - e.clientX,
                input.offsetTop - e.clientY
            ];
    }, true);

    input.addEventListener('mouseup', function () {
        input.isDown = false;
    }, true);

    input.addEventListener('mousemove', function (event) {
            event.preventDefault();
            if (input.isDown) {
                input.mousePosition = {

                    x: event.clientX,
                    y: event.clientY

                };
                input.style.left = (input.mousePosition.x + input.offset[0]) + 'px';
                input.style.top = (input.mousePosition.y + input.offset[1]) + 'px';
                resizeDiv.style.left = (input.mousePosition.x + input.offset[0] + input.width) + 10 + 'px';
                resizeDiv.style.top = (input.mousePosition.y + input.offset[1] + input.height) + 10 + 'px';
                widthInput.setAttribute('value', (input.mousePosition.x + input.offset[0]));
                heightInput.setAttribute('value', (input.mousePosition.y + input.offset[1]));
            }
    }, true);

    // resizeDiv.addEventListener('mousedown', function(e) {
    //     resizeDiv.isDown = true;
    //     beginCoordinates = [e.clientX, e.clientY];
    //     // console.log(beginCoordinates);
    // })
    //
    // resizeDiv.addEventListener('mousemove', function (e) {
    //     e.preventDefault();
    //     if (resizeDiv.isDown) {
    //         inputSize.width += e.clientX - beginCoordinates[0];
    //         inputSize.height += e.clientY - beginCoordinates[1];
    //         input.style.width = inputSize.width  + 'px';
    //         input.style.width = inputSize.height + 'px';
    //         resizeDiv.style.left = e.clientX + 'px';
    //         resizeDiv.style.top = e.clientY + 'px';
    //         beginCoordinates = [e.clientX, e.clientY];
    //     }
    // })
    //
    // resizeDiv.addEventListener('mouseup', function () {
    //     resizeDiv.isDown = false;
    // }, true);
}
