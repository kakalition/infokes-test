import mitt from 'mitt'

const emitter = mitt();
const ON_FOLDER_OPEN = "ON_FOLDER_OPEN"

export { emitter, ON_FOLDER_OPEN };