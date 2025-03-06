
<?php  
 session_start();
 if (!isset($_SESSION['auth_user'])) {
     header("location:http://localhost/gymphp/login.php");
     die();
 }

error_reporting(0);
 //include "../include/header.php";
?>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
      /* body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        height: 100vh;
      } */
      .chat-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100vh;
      }
      .chat-header {
        background-color: #202123;
        color: #ffffff;
        padding: 20px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
      }
      .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      .message {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        max-width: 70%;
      }
      .message.user {
        align-self: flex-end;
        background-color: #d1e7dd;
        color: #1a3b34;
        text-align: right;
      }
      .message.bot {
        align-self: flex-start;
        background-color: #f1f1f1;
        color: #000000;
        text-align: left;
      }
      .chat-footer {
        padding: 20px;
        background-color: #ffffff;
        display: flex;
        gap: 10px;
        border-top: 1px solid #e0e0e0;
      }
      .chat-footer input {
        flex: 1;
        padding: 10px;
        border: 1px solid #dcdcdc;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
      }
      .chat-footer button {
        background-color: #10a37f;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
      }
      .stop-btn {
        margin-top: 10px;
        background-color: #10a37f;
        color: #ffffff;
        border: none;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        cursor: pointer;
        display: none;
      }
    </style>
  </head>
  <body>
    <?php //include "../include/nav.php"?>
    <div class="main-content">

    <div class="chat-container">
      <div class="chat-header"><?php echo $_SESSION['auth_user']['email'];?> Food Assistant</div>
      <div id="messages" class="chat-body"></div>
      <div class="chat-footer">
        <input
          type="text"
          id="inputPrompt"
          placeholder="Ask about gym food or diet tips..."
        />
        <button id="sendPromptBtn" onclick="GetResponse()">Send</button>
      </div>
      <button class="stop-btn" id="stopBtn" onclick="stopSpeech()">Stop Speaking</button>
    </div>
</div>
    <script>
      const messagesContainer = document.getElementById("messages");
      const inputPrompt = document.getElementById("inputPrompt");
      const sendPromptBtn = document.getElementById("sendPromptBtn");
      const stopBtn = document.getElementById("stopBtn");
      let currentUtterance = null;

      function autoScroll() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
      }

      function cleanResponse(text) {
        return text
          .replace(/^\*\*|^\*|^\./gm, "")
          .replace(/\*\*/g, "")
          .replace(/\n+/g, "\n")
          .trim();
      }

      function startSpeech(response) {
        if (currentUtterance || speechSynthesis.speaking) return;

        currentUtterance = new SpeechSynthesisUtterance(response);
        currentUtterance.lang = "en-US";

        currentUtterance.onend = () => {
          stopBtn.style.display = 'none'; // Hide stop button when speech ends
        };

        speechSynthesis.speak(currentUtterance);
        stopBtn.style.display = 'inline-block'; // Show stop button
      }

      function stopSpeech() {
        if (currentUtterance && speechSynthesis.speaking) {
          speechSynthesis.cancel();
          currentUtterance = null;
          stopBtn.style.display = 'none'; // Hide stop button when speech is canceled
        }
      }

      function GetResponse() {
        const promptValue = inputPrompt.value.trim();
        if (!promptValue) return;

        sendPromptBtn.innerHTML = `Sending <div class="spinner-border spinner-border-sm" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
        sendPromptBtn.disabled = true;

        messagesContainer.innerHTML += `
          <div class="message user">
            <p>${promptValue}</p>
          </div>`;
        autoScroll();

        const roleValue =
          "You are a Gym Food Assistant who gives advice on meal plans, post-workout meals, and healthy eating. Be concise and use bullet points for your responses.";

        fetch(
          "http://localhost/auth/api.php?role=" +
            encodeURIComponent(roleValue) +
            "&&prompt=" +
            encodeURIComponent(promptValue)
        )
          .then((res) => {
            if (res.ok) return res.json();
            throw new Error("Network response was not ok.");
          })
          .then((data) => {
            const botResponse = cleanResponse(data.choices[0].message.content);

            // Add bot's response with the Stop button
            const botMessageHTML = `
              <div class="message bot">
                <p>${botResponse.replace(/\n/g, "<br>")}</p>
              </div>`;
            messagesContainer.innerHTML += botMessageHTML;

            startSpeech(botResponse); // Automatically start speaking the response

            autoScroll();
            inputPrompt.value = "";
            sendPromptBtn.innerHTML = "Send";
            sendPromptBtn.disabled = false;
          })
          .catch((error) => {
            messagesContainer.innerHTML += `
              <div class="message bot">
                <p>Sorry, there was an error processing your request.</p>
              </div>`;
            autoScroll();
            sendPromptBtn.innerHTML = "Send";
            sendPromptBtn.disabled = false;
          });
      }
    </script>
  </body>
</html>
