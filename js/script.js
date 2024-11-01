document.addEventListener('DOMContentLoaded', function() {
    const typingElement = document.getElementById('typing-effect');
    if (!typingElement) {
        console.error('Element with id "typing-effect" not found.');
        return;
    }
    
    // Function to get a dynamic greeting based on the time of day
    function getGreeting() {
        const hour = new Date().getHours();
        if (hour < 12) {
            return "सुप्रभातम्"; // Good Morning
        } else if (hour < 13) {
            return "शुभ मध्यान्हम्"; // Good Noon
        } else if (hour < 18) {
            return "शुभ अपराह्णम्"; // Good Afternoon
        } else if (hour < 20) {
            return "शुभ सन्ध्या"; // Good Evening
        } else {
            return "शुभ रात्रिः"; // Good Night
        }
    }
    
    const greeting = getGreeting();
    const words = [greeting, "ज्ञानम् एव मोक्षः"]; // Knowledge is liberation
    let wordIndex = 0;
    let charIndex = 0;
    const typingDelay = 100;

    function typeWord() {
        if (charIndex < words[wordIndex].length) {
            typingElement.textContent += words[wordIndex][charIndex];
            charIndex++;
            setTimeout(typeWord, typingDelay);
        } else {
            setTimeout(eraseWord, typingDelay * 2);
        }
    }

    function eraseWord() {
        if (charIndex > 0) {
            typingElement.textContent = typingElement.textContent.slice(0, -1);
            charIndex--;
            setTimeout(eraseWord, typingDelay);
        } else {
            wordIndex = (wordIndex + 1) % words.length;
            setTimeout(typeWord, typingDelay);
        }
    }

    typeWord();

    
    document.addEventListener('keydown', function(event) {
        if (event.key === 'x' || event.key === 'X') {  
            window.location.href = '../codered/easteregg.html'; 
        }
    });


    let tapCount = 0;
    document.addEventListener('touchstart', function() {
        tapCount++;
        setTimeout(() => { tapCount = 0; }, 500);

        if (tapCount === 3) {
            window.location.href = '../codered/easteregg.html';
        }
    });
});
