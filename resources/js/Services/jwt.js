"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
Object.defineProperty(exports, "__esModule", { value: true });
var jwt = /** @class */ (function () {
    function jwt() {
    }
    Object.defineProperty(jwt, "accessToken", {
        /* end set functions */
        /* start get functions */
        get: function () {
            return window.localStorage.getItem(jwt.TOKEN_KEY);
        },
        /* start set functions */
        set: function (token) {
            window.localStorage.setItem(jwt.TOKEN_KEY, token);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(jwt, "refreshToken", {
        get: function () {
            return window.localStorage.getItem(jwt.REFRESH_TOKEN_KEY) || '';
        },
        set: function (token) {
            window.localStorage.setItem(jwt.REFRESH_TOKEN_KEY, token);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(jwt, "expiresIn", {
        get: function () {
            return window.localStorage.getItem(jwt.EXPIRES_IN_KEY);
        },
        set: function (date) {
            window.localStorage.setItem(jwt.EXPIRES_IN_KEY, Date.now() + (date * 1000).toString());
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(jwt, "tokenType", {
        get: function () {
            return window.localStorage.getItem(jwt.TOKEN_TYPE_KEY);
        },
        set: function (date) {
            window.localStorage.setItem(jwt.TOKEN_TYPE_KEY, date);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(jwt, "User", {
        get: function () {
            return JSON.parse(window.localStorage.getItem(jwt.USER_KEY));
        },
        set: function (user) {
            window.localStorage.setItem(jwt.USER_KEY, JSON.stringify(user));
        },
        enumerable: false,
        configurable: true
    });
    ;
    Object.defineProperty(jwt, "Authorization", {
        get: function () {
            return jwt.tokenType + ' ' + jwt.accessToken;
        },
        enumerable: false,
        configurable: true
    });
    ;
    Object.defineProperty(jwt, "if_accessToken_expire", {
        get: function () {
            return jwt.expiresIn < Date.now();
        },
        enumerable: false,
        configurable: true
    });
    ;
    /* end get functions */
    /* start destroy functions */
    jwt.destroyAccessToken = function () {
        window.localStorage.removeItem(jwt.TOKEN_KEY);
    };
    jwt.destroyRefreshToken = function () {
        window.localStorage.removeItem(jwt.REFRESH_TOKEN_KEY);
    };
    jwt.destroyExpiresIn = function () {
        window.localStorage.removeItem(jwt.EXPIRES_IN_KEY);
    };
    jwt.destroyTokenType = function () {
        window.localStorage.removeItem(jwt.TOKEN_TYPE_KEY);
    };
    jwt.destroyUser = function () {
        window.localStorage.removeItem(jwt.USER_KEY);
    };
    /* end destroy functions */
    jwt.setBearerTokenResponse = function (BearerToke) {
        jwt.accessToken = BearerToke.accessToken;
        jwt.refreshToken = BearerToke.refresh_token;
        jwt.expiresIn = BearerToke.expires_in;
        jwt.tokenType = BearerToke.token_type;
    };
    jwt.login = function (AuthResponse) {
        // return console.log(  AuthRsponse.Token.accessToken , 222333 );
        jwt.setBearerTokenResponse(AuthResponse.Token);
        jwt.User = AuthResponse.user;
    };
    jwt.logout = function () {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                jwt.destroyAccessToken();
                jwt.destroyRefreshToken();
                jwt.destroyExpiresIn();
                jwt.destroyTokenType();
                jwt.destroyUser();
                return [2 /*return*/];
            });
        });
    };
    jwt.TOKEN_KEY = 'ACCESS_TOKEN';
    jwt.REFRESH_TOKEN_KEY = 'REFRESH_TOKEN';
    jwt.EXPIRES_IN_KEY = 'EXPIRES_IN';
    jwt.TOKEN_TYPE_KEY = 'TOKEN_TYPE';
    jwt.USER_KEY = 'USER';
    return jwt;
}());
exports.default = jwt;
;
