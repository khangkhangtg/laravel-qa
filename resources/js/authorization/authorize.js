import policies from './policies';

export default {
    install (Vue, option) {
        Vue.prototype.authorize = function (policy, model) {
            if (! window.Auth.signedIn) return false;
            console.log('signed in');
            if (typeof policy === 'string' && typeof model === 'object') {
                const user = window.Auth.user;
        
                return policies[policy](user, model);
                // Ex: Call method: authorize('modify', answer) 
                // So: policy === 'modify' 
                // return policies['mofify'](user, model)
                // similar to: return polices.modify(user, model)
            }
        }

        Vue.prototype.signedIn = window.Auth.signedIn;
    }
}