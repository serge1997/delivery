import { ElNotification } from "element-plus";

export class Notify{

    success(message, title = null){
        ElNotification({
            type: "success",
            message: message,
            title: title
        })
    }
    error(message, title = null){
        ElNotification({
            type: "error",
            message: message,
            title: title
        })
    }
    warning(message, title = null){
        ElNotification({
            type: "warning",
            message: message,
            title: title
        })
    }

}
