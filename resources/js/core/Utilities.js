const isNull = (arg) => arg == null;
const isNullOrWhiteSpace = (arg) => arg == null || arg == "";
const is = (arg, value) => arg == value;

function when(condition, trueValue, defaultValue =  null){
    if (condition){
        return is(typeof trueValue, "function") ?
        trueValue() : trueValue;
    }else{
        if (defaultValue){
            return !isNull(defaultValue) && is(typeof defaultValue, "function")
            ? defaultValue() : defaultValue;
        }
        return null;
    }
}

export {
    isNull,
    isNullOrWhiteSpace,
    when,
    is
}
