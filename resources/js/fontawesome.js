import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { faCaretUp, faCaretDown, faStar, faCheck } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas, faCaretUp, faCaretDown, faStar, faCheck)

// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch()