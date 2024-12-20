<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elders' Care Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/contact.css" rel="stylesheet">
</head>
<body>
    <section class="h-100 h-custom gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <h3 class="fw-normal mb-5" style="color: #4835d4;">Parent's Information</h3>
                                        
                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="parentName">Parent's Name</label>
                                                <input type="text" id="parentName" class="form-control form-control-lg" />
                                                
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="parentAge">Age</label>
                                                <input type="number" id="parentAge" class="form-control form-control-lg" />
                                                
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="healthConditions">Health Conditions</label>
                                                <input type="text" id="healthConditions" class="form-control form-control-lg" />
                                                
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="additionalNotes">Additional Notes</label>
                                                <textarea id="additionalNotes" class="form-control form-control-lg" rows="4"></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 bg-indigo text-white">
                                    <div class="p-5">
                                        <h3 class="fw-normal mb-5">Contact & Services</h3>
                                        
                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <input type="email" id="contactEmail" class="form-control form-control-lg" />
                                                <label class="form-label text-white" for="contactEmail">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="contactNumber" class="form-control form-control-lg" />
                                                <label class="form-label text-white" for="contactNumber">Contact Number</label>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <select class="form-select form-control-lg">
                                                <option value="" disabled selected>Select Service</option>
                                                <option value="health">Health Check-ups</option>
                                                <option value="daily">Daily Assistance</option>
                                                <option value="shopping">Shopping Support</option>
                                                <option value="companionship">Companionship</option>
                                            </select>
                                        </div>

                                        <div class="form-check d-flex justify-content-start mb-4">
                                            <input class="form-check-input me-3" type="checkbox" value="" id="terms" />
                                            <label class="form-check-label text-white" for="terms">
                                                I accept the <a href="#" class="text-white"><u>Terms and Conditions</u></a>.
                                            </label>
                                        </div>

                                        <button type="button" class="btn btn-light btn-lg" data-mdb-ripple-color="dark">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
