export function isInputEmpty(input){
    return !input
}

export function isAlphabetic(input){
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(input);
}

export function isValidEmail(input){
    const regex = /^[a-zA-Z0-9]+([\.\-\_][a-zA-Z0-9]+)*@[a-zA-Z0-9]+([\-\.][a-zA-Z0-9]+)*(\.[a-zA-Z]{2,})+$/;
    return regex.test(input);
}

export function makeSingleSpaced(input){
    return input.replace(/\s\s+/g, ' ');
}

export function isSpecificLength(input, length){
    return input.length >= length;
}


