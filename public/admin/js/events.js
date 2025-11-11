function showSection(type) {
    const upcomingTab = document.getElementById("upcoming-tab");
    const ongoingTab = document.getElementById("ongoing-tab");
    const registeredTab = document.getElementById("registered-tab");
    const completedTab = document.getElementById("completed-tab");
    const upcomingSection = document.getElementById("upcoming-section");
    const ongoingSection = document.getElementById("ongoing-section");
    const registeredSection = document.getElementById("registered-section");
    const completedSection = document.getElementById("completed-section");
    if (type === "upcoming") {
        upcomingSection.classList.remove("hidden");
        ongoingSection.classList.add("hidden");
        registeredSection.classList.add("hidden");
        completedSection.classList.add("hidden");
        upcomingTab.classList.add("bg-primary", "text-white", "rounded-full");
        ongoingTab.classList.remove("bg-primary", "text-white", "rounded-full");
        registeredTab.classList.remove("bg-primary", "text-white", "rounded-full");
        completedTab.classList.remove("bg-primary", "text-white", "rounded-full");
    } else if (type === "ongoing") {
        ongoingSection.classList.remove("hidden");
        upcomingSection.classList.add("hidden");
        registeredSection.classList.add("hidden");
        completedSection.classList.add("hidden");
        ongoingTab.classList.add("bg-primary", "text-white", "rounded-full");
        upcomingTab.classList.remove("bg-primary","text-white","rounded-full");
        registeredTab.classList.remove("bg-primary","text-white","rounded-full" );
        completedTab.classList.remove("bg-primary","text-white","rounded-full");
    }else if (type === "registered") {
        registeredSection.classList.remove("hidden");
        upcomingSection.classList.add("hidden");
        completedSection.classList.add("hidden");
        ongoingSection.classList.add("hidden");
        registeredTab.classList.add(
            "bg-primary",
            "text-white",
            "rounded-full"
        );
          upcomingTab.classList.remove(
              "bg-primary",
              "text-white",
              "rounded-full"
          );
            ongoingTab.classList.remove(
                "bg-primary",
                "text-white",
                "rounded-full"
            );
          completedTab.classList.remove(
              "bg-primary",
              "text-white",
              "rounded-full"
          );

    }else if (type === "completed") {
         registeredSection.classList.add("hidden");
         upcomingSection.classList.add("hidden");
         completedSection.classList.remove("hidden");
         ongoingSection.classList.add("hidden");
         registeredTab.classList.remove(
             "bg-primary",
             "text-white",
             "rounded-full"
         );
         upcomingTab.classList.remove(
             "bg-primary",
             "text-white",
             "rounded-full"
         );
         ongoingTab.classList.remove(
             "bg-primary",
             "text-white",
             "rounded-full"
         );
         completedTab.classList.add(
             "bg-primary",
             "text-white",
             "rounded-full"
         );

    }
}
