


const scriptsInEvents = {

		async Egame_Event175_Act1(runtime, localVars)
		{
			try {
			if (messageHandler) {
				var str = localVars.message;
				var sanitize = str.replace(/[^\w]/g, ' ');
				messageHandler.postMessage(sanitize);
				
				runtime.callFunction("LogMessage", ["Done"]);
			}} catch (err) {
				runtime.callFunction("LogMessage", ["Handler is undefined"]);
			}
		}

};

self.C3.ScriptsInEvents = scriptsInEvents;

