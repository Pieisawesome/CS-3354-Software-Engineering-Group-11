let skillSet = new Set();

function addSkill() {
    const skill = document.getElementById('skillInput').value.trim();
    if (skill && !skillSet.has(skill)) {
        skillSet.add(skill);
        updateSkillDisplay();
        document.getElementById('skillInput').value = '';
    }
}

function removeSkill(skill) {
    skillSet.delete(skill);
    updateSkillDisplay();
}

function updateSkillDisplay() {
    const container = document.getElementById('skillContainer');
    container.innerHTML = '';
    skillSet.forEach(skill => {
        const tag = document.createElement('span');
        tag.className = 'skill-tag';
        tag.innerHTML = `${skill} <span class="delete-skill" onclick="removeSkill('${skill}')">&times;</span>`;
        container.appendChild(tag);
    });
}

function saveSkills() {
    const skills = Array.from(skillSet);
    fetch('save_skills.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ skills: skills })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Skills saved successfully!');
        } else {
            alert('Error saving skills.');
        }
    })
    .catch(error => console.error('Error:', error));
}