package com.controller;

import com.domain.Authority;
import com.domain.User;
import com.service.RegistrationService;
import com.service.UserService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;

@CrossOrigin()
@RestController
@RequestMapping("/register")
public class RegistrationController {

    private RegistrationService registrationService;

    public RegistrationController(RegistrationService registrationService) {
        this.registrationService = registrationService;
    }

    @PostMapping("/user")
    public boolean registerUser(@Valid @RequestBody User user) {
        registrationService.insert(user);
        return true;
    }

    @RequestMapping("/test")
    public String testing() {
        return "hi";
    }

    @PostMapping("/admin")
    public boolean registerAdmin(@Valid @RequestBody User user) {
        registrationService.insert(user);
        return true;
    }
}