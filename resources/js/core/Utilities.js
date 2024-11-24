const isNull = (arg) => arg == null;
const isNullOrWhiteSpace = (arg) => arg == null || arg == "";
const is = (arg, value) => arg == value;
const popUpConfirmMessage = (status, entity) =>  status == 1 ? `voulez vous desactiver cet(te) ${entity} ?` :
                    `voulez vous activer cet(te) ${entity} ?`

function when(condition, trueValue, defaultValue =  null){
    if (condition){
        return is(typeof trueValue, "function") ?
        trueValue() : trueValue;
    }else{
        alert("hey")
        if (defaultValue){
            return !isNull(defaultValue) && is(typeof defaultValue, "function")
            ? defaultValue() : defaultValue;
        }
        return null;
    }
}
function clearNumberMask(value = null){
    return value ? value.replaceAll(/\D/g, '') : null;
}

export {
    isNull,
    isNullOrWhiteSpace,
    popUpConfirmMessage,
    when,
    clearNumberMask,
    is
}
