
document.getElementById('add_answer').addEventListener('click', function () {

    const outerDiv = document.createElement('div');
    outerDiv.classList.add('mb-3');

// Create the label for the answer input
    const label = document.createElement('label');
    label.setAttribute('for', 'answer');
    label.classList.add('form-label');
    label.textContent = 'Answer';

// Create the input group div
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group');

// Create the input field
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'answer[]';
    input.id = 'answer';
    input.classList.add('form-control');
    input.required = true;

    inputGroup.appendChild(input);
    outerDiv.appendChild(label);
    outerDiv.appendChild(inputGroup);



    const referenceElement = document.querySelector('.submit-button');


    referenceElement.parentNode.insertBefore(outerDiv, referenceElement);
});

